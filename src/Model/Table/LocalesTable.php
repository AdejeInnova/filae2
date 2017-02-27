<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Locales Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Superficies
 * @property \Cake\ORM\Association\BelongsToMany $Communications
 *
 * @method \App\Model\Entity\Locale get($primaryKey, $options = [])
 * @method \App\Model\Entity\Locale newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Locale[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Locale|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Locale patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Locale[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Locale findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class LocalesTable extends Table
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

        $this->table('locales');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Communications', [
            'foreignKey' => 'locale_id',
            'targetForeignKey' => 'communication_id',
            'joinTable' => 'communications_locales'
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
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->email('email')
            ->allowEmpty('email');

        $validator
            ->allowEmpty('description');

        $validator
            ->integer('tag_count')
            ->allowEmpty('tag_count');

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
        $rules->add($rules->isUnique(['email']));
        $rules->add($rules->existsIn(['superficie_id'], 'Superficies'));

        return $rules;
    }
}
