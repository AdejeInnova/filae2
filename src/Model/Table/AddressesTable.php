<?php
namespace App\Model\Table;

use Cake\Core\Configure;
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
            ->boolean('principal')
            ->allowEmpty('principal');

        $validator
            ->allowEmpty('latlon');

        $validator
            ->requirePresence('CCOM', 'create')
            ->notEmpty('CCOM');

        $validator
            ->requirePresence('COM', 'create')
            ->notEmpty('COM');

        $validator
            ->requirePresence('CPRO', 'create')
            ->notEmpty('CPRO');

        $validator
            ->requirePresence('PRO', 'create')
            ->notEmpty('PRO');

        $validator
            ->requirePresence('CMUM', 'create')
            ->notEmpty('CMUM');

        $validator
            ->requirePresence('DMUN50', 'create')
            ->notEmpty('DMUN50');

        $validator
            ->requirePresence('NENTSI50', 'create')
            ->notEmpty('NENTSI50');

        $validator
            ->requirePresence('CUN', 'create')
            ->notEmpty('CUN');

        $validator
            ->requirePresence('NNUCLE50', 'create')
            ->notEmpty('NNUCLE50');

        $validator
            ->requirePresence('CPOS', 'create')
            ->notEmpty('CPOS');

        $validator
            ->requirePresence('CVIA', 'create')
            ->notEmpty('CVIA');

        $validator
            ->requirePresence('NVIAC', 'create')
            ->notEmpty('NVIAC');

        $validator
            ->requirePresence('TVIA', 'create')
            ->notEmpty('TVIA');

        $validator
            ->allowEmpty('ubicacion_id')
            ->add('ubicacion_id', 'inList', [
                'rule' => [
                    'inList',
                    array_keys(Configure::read('Ubicaciones'))
            ]
        ]);

        $validator
            ->allowEmpty('ubicacion_name');



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

    public function afterSave($event, $entity, $options){
        if (isset($entity['principal']) && ($entity['principal'])) {
            $q = $this->Companies->Addresses->query();
            $q->update()
                ->set(['principal' => false])
                ->where(['companie_id' => $entity['companie_id'], 'id !=' => $entity['id']])
                ->execute();
        }
    }
}
