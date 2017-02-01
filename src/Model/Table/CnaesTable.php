<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use ArrayObject;
use Cake\Collection\Collection;


/**
 * Cnaes Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Companies
 *
 * @method \App\Model\Entity\Cnae get($primaryKey, $options = [])
 * @method \App\Model\Entity\Cnae newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Cnae[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Cnae|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Cnae patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Cnae[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Cnae findOrCreate($search, callable $callback = null)
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class CnaesTable extends Table
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

        $this->table('cnaes');
        $this->displayField('titulo_cnae');
        $this->primaryKey('id');

        $this->addBehavior('Timestamp');

        $options = array(
            // Refer to php.net fgetcsv for more information
            'length' => 0,
            'delimiter' => ',',
            'enclosure' => '"',
            'escape' => '\\',
            // Generates a Model.field headings row from the csv file
            'headers' => true,
            // If true, String $content is the data, not a path to the file
            'text' => false,
        );

        $this->addBehavior('CakePHPCSV.Csv', $options);

        $this->belongsTo('Companies', [
            'foreignKey' => 'companie_id',
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
            ->requirePresence('cod_cnae', 'create')
            ->notEmpty('cod_cnae');

        $validator
            ->requirePresence('codintegr', 'create')
            ->notEmpty('codintegr');

        $validator
            ->requirePresence('titulo_cnae', 'create')
            ->notEmpty('titulo_cnae');

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
        $rules->add($rules->existsIn(['companie_id'], 'Companies'));
        return $rules;
    }

    public function beforeMarshal(Event $event, ArrayObject $data, ArrayObject $options)
    {
        if (isset($data['cnae'])){
            //Extraemos los datos de la collection de cnaes
            $content = 'data/cnae2009.csv';
            $collection = new Collection($this->importCsv($content));

            $cnae = $collection->filter(function($value, $key) use ($data){
                return $value['cod_cnae2009'] == $data['cnae'];
            });

            $temp = $cnae->toList();
            $data['cod_cnae'] = $temp[0]['cod_cnae2009'];
            $data['codintegr'] = $temp[0]['codintegr'];
            $data['titulo_cnae'] = $temp[0]['titulo_cnae2009'];
        }
    }
}
