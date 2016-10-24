<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Company Entity
 *
 * @property int $id
 * @property string $name
 * @property string $tradename
 * @property int $idcard_id
 * @property string $identity_card
 * @property string $description
 * @property int $company_id
 * @property int $address_id
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 *
 * @property \App\Model\Entity\Idcard $idcard
 * @property \App\Model\Entity\Company[] $companies
 * @property \App\Model\Entity\Address $address
 * @property \App\Model\Entity\Cnae[] $cnaes
 * @property \App\Model\Entity\Contact[] $contacts
 * @property \App\Model\Entity\Sede[] $sedes
 * @property \App\Model\Entity\Communication[] $communications
 * @property \App\Model\Entity\Network[] $networks
 */
class Company extends Entity
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
