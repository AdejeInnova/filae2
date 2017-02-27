<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * CommunicationsLocales Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Communications
 * @property \Cake\ORM\Association\BelongsTo $Locals
 *
 * @method \App\Model\Entity\CommunicationsLocale get($primaryKey, $options = [])
 * @method \App\Model\Entity\CommunicationsLocale newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\CommunicationsLocale[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\CommunicationsLocale|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\CommunicationsLocale patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\CommunicationsLocale[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\CommunicationsLocale findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CommunicationsLocalesTable extends Table
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

        $this->table('communications_locales');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Communications', [
            'foreignKey' => 'communication_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Locales', [
            'foreignKey' => 'local_id',
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
        $rules->add($rules->existsIn(['local_id'], 'Locales'));

        return $rules;
    }
}
