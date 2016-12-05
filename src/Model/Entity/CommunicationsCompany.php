<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CommunicationsCompany Entity
 *
 * @property int $id
 * @property string $value
 * @property int $communication_id
 * @property int $company_id
 *
 * @property \App\Model\Entity\Communication $communication
 * @property \App\Model\Entity\Company $company
 */
class CommunicationsCompany extends Entity
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
