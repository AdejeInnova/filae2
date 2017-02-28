<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Locale Entity
 *
 * @property int $id
 * @property string $email
 * @property string $description
 * @property int $superficie_id
 * @property int $tag_count
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Superficy $superficy
 * @property \App\Model\Entity\Communication[] $communications
 */
class Locale extends Entity
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
        'id' => false,
        'images' => true
    ];
}
