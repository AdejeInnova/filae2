<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Towns Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Townships
 * @property \Cake\ORM\Association\HasMany $Addresses
 * @property \Cake\ORM\Association\HasMany $Cores
 *
 * @method \App\Model\Entity\Town get($primaryKey, $options = [])
 * @method \App\Model\Entity\Town newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Town[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Town|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Town patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Town[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Town findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class TownsTable extends Table
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

        $this->table('towns');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Townships', [
            'foreignKey' => 'township_id',
            'joinType' => 'INNER'
        ]);
        $this->hasMany('Addresses', [
            'foreignKey' => 'town_id'
        ]);
        $this->hasMany('Cores', [
            'foreignKey' => 'town_id'
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
        $rules->add($rules->existsIn(['township_id'], 'Townships'));

        return $rules;
    }
}
