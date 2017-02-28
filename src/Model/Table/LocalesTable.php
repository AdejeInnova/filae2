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
            'foreignKey' => 'local_id',
            'targetForeignKey' => 'communication_id',
            'joinTable' => 'communications_locales'
        ]);

        $this->hasMany('Contacts', [
            'foreignKey' => 'local_id'
        ]);

        $this->addBehavior('Muffin/Tags.Tag',[
            'namespace' => 'locales'
        ]);

        $this->hasMany('Images', [
            'foreignKey' => 'local_id'
        ]);

        $this->hasMany('Addresses', [
            'foreignKey' => 'local_id'
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
            ->notEmpty('id');

        $validator
            ->requirePresence('name', 'create',['Campo requerido'])
            ->notEmpty('name', 'Este campo no puede estar vacío');

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


    // In a table or behavior class
    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['file_data'])) {
            $data['images'] = [0 =>['photo' => $data['file_data']]];
        }
    }

    public function afterSave($event, $entity, $options){
        if (isset($entity['images'][0]['profile']) && ($entity['images'][0]['profile'] == '1')) {
            $q = $this->Locales->Images->query();
            $q->update()
                ->set(['profile' => false])
                ->where(['companie_id' => $entity['id'], 'id !=' => $entity['images'][0]['id']])
                ->execute();
        }
    }


}
