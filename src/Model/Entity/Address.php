<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Address Entity
 *
 * @property int $id
 * @property int $road_id
 * @property string $address
 * @property int $number
 * @property int $block
 * @property int $floor
 * @property string $door
 * @property bool $default
 * @property string $latlon
 * @property int $town_id
 * @property int $person_id
 * @property string $core
 * @property int $postcode
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Road $road
 * @property \App\Model\Entity\Town $town
 * @property \App\Model\Entity\Person $person
 * @property \App\Model\Entity\Company[] $companies
 * @property \App\Model\Entity\Sede[] $sedes
 */
class Address extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}
