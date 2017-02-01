<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CommunicationsCompanies Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Communications
 * @property \Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\CommunicationsCompany get($primaryKey, $options = [])
 * @method \App\Model\Entity\CommunicationsCompany newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CommunicationsCompany[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CommunicationsCompany|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommunicationsCompany patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CommunicationsCompany[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CommunicationsCompany findOrCreate($search, callable $callback = null)
 */
class CommunicationsCompaniesTable extends Table
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

        $this->table('communications_companies');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Communications', [
            'foreignKey' => 'communication_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Companies', [
            'foreignKey' => 'company_id',
            'joinType' => 'INNER'
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
            ->requirePresence('value', 'create')
            ->notEmpty('value');

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
        $rules->add($rules->existsIn(['communication_id'], 'Communications'));
        $rules->add($rules->existsIn(['company_id'], 'Companies'));

        return $rules;
    }
}
