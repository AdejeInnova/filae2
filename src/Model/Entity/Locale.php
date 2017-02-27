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

}
