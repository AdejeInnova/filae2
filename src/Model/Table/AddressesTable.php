<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Addresses Model
 *
 * @property \Cake\ORM\Association\BelongsTo $People
 * @property \Cake\ORM\Association\BelongsTo $Companies
 * @property \Cake\ORM\Association\HasMany $Sedes
 *
 * @method \App\Model\Entity\Address get($primaryKey, $options = [])
 * @method \App\Model\Entity\Address newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Address[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Address|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Address patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Address[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Address findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AddressesTable extends Table
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

        $this->table('addresses');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Persons', [
            'foreignKey' => 'person_id'
        ]);
        $this->belongsTo('Companies', [
            'foreignKey' => 'companie_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Sedes', [
            'foreignKey' => 'address_id'
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
            ->integer('number')
            ->requirePresence('number', 'create')
            ->notEmpty('number');

        $validator
            ->integer('block')
            ->allowEmpty('block');

        $validator
            ->integer('floor')
            ->allowEmpty('floor');

        $validator
            ->allowEmpty('door');

        $validator
            ->boolean('default')
            ->allowEmpty('default');

        $validator
            ->allowEmpty('latlon');

        $validator
            ->allowEmpty('CCOM');

        $validator
            ->allowEmpty('COM');

        $validator
            ->allowEmpty('CPRO');

        $validator
            ->allowEmpty('PRO');

        $validator
            ->allowEmpty('CMUM');

        $validator
            ->allowEmpty('DMUN50');

        $validator
            ->allowEmpty('NENTSI50');

        $validator
            ->allowEmpty('CUN');

        $validator
            ->allowEmpty('NNUCLE50');

        $validator
            ->allowEmpty('CPOS');

        $validator
            ->allowEmpty('CVIA');

        $validator
            ->allowEmpty('NVIAC');

        $validator
            ->allowEmpty('TVIA');

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
        $rules->add($rules->existsIn(['person_id'], 'Persons'));
        $rules->add($rules->existsIn(['companie_id'], 'Companies'));

        return $rules;
    }
}
