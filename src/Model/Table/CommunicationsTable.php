<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Communications Model
 *
 * @property \Cake\ORM\Association\BelongsToMany $Companies
 * @property \Cake\ORM\Association\BelongsToMany $Persons
 * @property \Cake\ORM\Association\BelongsToMany $Contacts
 *
 * @method \App\Model\Entity\Communication get($primaryKey, $options = [])
 * @method \App\Model\Entity\Communication newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Communication[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Communication|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Communication patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Communication[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Communication findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CommunicationsTable extends Table
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

        $this->table('communications');
        $this->displayField('name');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $this->belongsToMany('Companies', [
            'foreignKey' => 'communication_id',
            'targetForeignKey' => 'company_id',
            'joinTable' => 'communications_companies'
        ]);
        $this->belongsToMany('Persons', [
            'foreignKey' => 'communication_id',
            'targetForeignKey' => 'person_id',
            'joinTable' => 'communications_persons'
        ]);
        $this->belongsToMany('Contacts', [
            'foreignKey' => 'communication_id',
            'targetForeignKey' => 'contact_id',
            'joinTable' => 'contacts_communications'
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
