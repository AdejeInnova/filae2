<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

// Include use statements at the top of your file.
use Cake\Event\Event;
use ArrayObject;

/**
 * Companies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Idcards
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\BelongsTo $Addresses
 * @property \Cake\ORM\Association\HasMany $Cnaes
 * @property \Cake\ORM\Association\HasMany $Companie
 * @property \Cake\ORM\Association\HasMany $Contacts
 * @property \Cake\ORM\Association\HasMany $Sedes
 * @property \Cake\ORM\Association\BelongsToMany $Communications
 * @property \Cake\ORM\Association\BelongsToMany $Networks
 *
 * @method \App\Model\Entity\Company get($primaryKey, $options = [])
 * @method \App\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CompaniesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('companies');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Idcards', [
            'foreignKey' => 'idcard_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id'
        ]);
        $this->belongsTo('Addresses', [
            'foreignKey' => 'address_id'
        ]);
        $this->hasMany('Cnaes', [
            'foreignKey' => 'companie_id'
        ]);
        $this->hasMany('Companies', [
            'foreignKey' => 'companie_id'
        ]);
        $this->hasMany('Contacts', [
            'foreignKey' => 'companie_id'
        ]);
        $this->hasMany('Sedes', [
            'foreignKey' => 'companie_id'
        ]);

        $this->hasMany('Images', [
            'foreignKey' => 'companie_id'
        ]);

        $this->belongsToMany('Communications', [
            'foreignKey' => 'company_id',
            'targetForeignKey' => 'communication_id',
            'joinTable' => 'communications_companies'
        ]);
        $this->belongsToMany('Networks', [
            'foreignKey' => 'company_id',
            'targetForeignKey' => 'network_id',
            'joinTable' => 'companies_networks'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->allowEmpty('tradename');

        $validator
            ->requirePresence('identity_card', 'create')
            ->notEmpty('identity_card');

        $validator
            ->allowEmpty('description');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['idcard_id'], 'Idcards'));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));
        $rules->add($rules->existsIn(['address_id'], 'Addresses'));

        return $rules;
    }


    // In a table or behavior class
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['file_data'])) {
            $data['images'] = [0 =>['photo' => $data['file_data']]];
        }
    }


    public function afterSave($event, $entity, $options){
        if (isset($entity['images'][0]['profile']) && ($entity['images'][0]['profile'] == '1')) {
            $q = $this->Companies->Images->query();
            $q->update()
                ->set(['profile' => false])
                ->where(['companie_id' => $entity['id'], 'id !=' => $entity['images'][0]['id']])
                ->execute();
        }
    }



}
