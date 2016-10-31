<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Idcards Model
 *
 * @property \Cake\ORM\Association\HasMany $Companies
 * @property \Cake\ORM\Association\HasMany $Persons
 *
 * @method \App\Model\Entity\Idcard get($primaryKey, $options = [])
 * @method \App\Model\Entity\Idcard newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Idcard[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Idcard|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Idcard patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Idcard[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Idcard findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class IdcardsTable extends Table
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

        $this->table('idcards');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->hasMany('Companies', [
            'foreignKey' => 'idcard_id'
        ]);
        $this->hasMany('Persons', [
            'foreignKey' => 'idcard_id'
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
            ->boolean('person')
            ->requirePresence('person', 'create')
            ->notEmpty('person');

        $validator
            ->boolean('company')
            ->requirePresence('company', 'create')
            ->notEmpty('company');

        return $validator;
    }
}
