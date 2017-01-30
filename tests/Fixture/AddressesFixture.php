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
        'person_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => 'id persona', 'precision' => null, 'autoIncrement' => null],
        'companie_id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CCOM' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Código Comunidad', 'precision' => null, 'fixed' => null],
        'COM' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Nombre Comunidad', 'precision' => null, 'fixed' => null],
        'CPRO' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Código Provincia', 'precision' => null, 'fixed' => null],
        'PRO' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Nombre Provincia', 'precision' => null, 'fixed' => null],
        'CMUM' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Código Municipio', 'precision' => null, 'fixed' => null],
        'DMUN50' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Nombre Municipio', 'precision' => null, 'fixed' => null],
        'NENTSI50' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Nombre Población', 'precision' => null, 'fixed' => null],
        'CUN' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Código Núcleo', 'precision' => null, 'fixed' => null],
        'NNUCLE50' => ['type' => 'string', 'length' => 100, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Nombre Núcleo', 'precision' => null, 'fixed' => null],
        'CPOS' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Código Postal', 'precision' => null, 'fixed' => null],
        'CVIA' => ['type' => 'string', 'length' => 10, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Código de La Vía (Nombre de la calle)', 'precision' => null, 'fixed' => null],
        'NVIAC' => ['type' => 'string', 'length' => 255, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Nombre de la Vía - Calle.', 'precision' => null, 'fixed' => null],
        'TVIA' => ['type' => 'string', 'length' => 50, 'null' => true, 'default' => null, 'collate' => 'utf8_unicode_ci', 'comment' => 'Tipo de Vía (Calle, Plaza, Ctra, ...)', 'precision' => null, 'fixed' => null],
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
            'number' => 1,
            'block' => 1,
            'floor' => 1,
            'door' => 'Lorem ipsum dolor sit amet',
            'default' => 1,
            'latlon' => 'Lorem ipsum dolor sit amet',
            'person_id' => 1,
            'companie_id' => 1,
            'CCOM' => 'Lorem ip',
            'COM' => 'Lorem ipsum dolor sit amet',
            'CPRO' => 'Lorem ip',
            'PRO' => 'Lorem ipsum dolor sit amet',
            'CMUM' => 'Lorem ip',
            'DMUN50' => 'Lorem ipsum dolor sit amet',
            'NENTSI50' => 'Lorem ipsum dolor sit amet',
            'CUN' => 'Lorem ip',
            'NNUCLE50' => 'Lorem ipsum dolor sit amet',
            'CPOS' => 'Lorem ip',
            'CVIA' => 'Lorem ip',
            'NVIAC' => 'Lorem ipsum dolor sit amet',
            'TVIA' => 'Lorem ipsum dolor sit amet',
            'created' => '2017-01-25 12:58:25',
            'modified' => '2017-01-25 12:58:25'
        ],
    ];
}
