<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Timetable Entity
 *
 * @property int $id
 * @property int $companie_id
 * @property bool $24hours
 * @property string $days
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Company $company
 * @property \App\Model\Entity\Openinghour[] $openinghours
 */
class Timetable extends Entity
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
