<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Address Entity
 *
 * @property int $id
 * @property int $number
 * @property int $block
 * @property int $floor
 * @property string $door
 * @property bool $default
 * @property string $latlon
 * @property int $person_id
 * @property int $companie_id
 * @property string $CCOM
 * @property string $COM
 * @property string $CPRO
 * @property string $PRO
 * @property string $CMUM
 * @property string $DMUN50
 * @property string $NENTSI50
 * @property string $CUN
 * @property string $NNUCLE50
 * @property string $CPOS
 * @property string $CVIA
 * @property string $NVIAC
 * @property string $TVIA
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Person $person
 * @property \App\Model\Entity\Company $company
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
