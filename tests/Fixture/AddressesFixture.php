<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AddressesFixture
 *
 */
class AddressesFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'road_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'tipo de vía (tabla roads)', 'precision' => null, 'autoIncrement' => null],
        'address' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'nombre calle
', 'precision' => null, 'fixed' => null],
        'number' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'número dirección
', 'precision' => null, 'autoIncrement' => null],
        'block' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'Bloque del edificio
', 'precision' => null, 'autoIncrement' => null],
        'floor' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'piso del edificio
', 'precision' => null, 'autoIncrement' => null],
        'door' => ['type' => 'string', 'length' => 45, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'puerta
', 'precision' => null, 'fixed' => null],
        'default' => ['type' => 'boolean', 'length' => null, 'null' => true, 'default' => null, 'comment' => 'Este campo es si la dirección es la dirección de la persona o empresa por defecto.', 'precision' => null],
        'latlon' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'latitud - longitud de ubicación.
', 'precision' => null, 'fixed' => null],
        'town_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'id población (tabla towns)
', 'precision' => null, 'autoIncrement' => null],
        'person_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'id persona
', 'precision' => null, 'autoIncrement' => null],
        'core' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'núcleo -> texto obtenido de la tabla cores.', 'precision' => null, 'fixed' => null],
        'postcode' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'código postal
', 'precision' => null, 'autoIncrement' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'datetime', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_unicode_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'road_id' => 1,
            'address' => 'Lorem ipsum dolor sit amet',
            'number' => 1,
            'block' => 1,
            'floor' => 1,
            'door' => 'Lorem ipsum dolor sit amet',
            'default' => 1,
            'latlon' => 'Lorem ipsum dolor sit amet',
            'town_id' => 1,
            'person_id' => 1,
            'core' => 'Lorem ipsum dolor sit amet',
            'postcode' => 1,
            'created' => '2016-10-31 18:55:04',
            'modified' => '2016-10-31 18:55:04'
        ],
    ];
}
