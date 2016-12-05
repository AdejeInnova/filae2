<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CompaniesNetwork Entity
 *
 * @property int $id
 * @property string $url
 * @property int $network_id
 * @property int $company_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Network $network
 * @property \App\Model\Entity\Company $company
 */
class CompaniesNetwork extends Entity
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
