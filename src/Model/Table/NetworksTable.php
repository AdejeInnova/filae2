<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Networks Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Companies
 * @property \Cake\ORM\Association\BelongsToMany $Persons
 *
 * @method \App\Model\Entity\Network get($primaryKey, $options = [])
 * @method \App\Model\Entity\Network newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Network[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Network|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Network patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Network[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Network findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class NetworksTable extends Table
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

        $this->table('networks');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Companies', [
            'foreignKey' => 'network_id',
            'targetForeignKey' => 'company_id',
            'joinTable' => 'companies_networks'
        ]);
        $this->belongsToMany('Persons', [
            'foreignKey' => 'network_id',
            'targetForeignKey' => 'person_id',
            'joinTable' => 'networks_persons'
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
            ->allowEmpty('class');

        return $validator;
    }
}
