<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Camarero Entity
 *
 * @property int $id
 * @property int $id_empresa
 * @property string $descripcion
 * @property string $email
 * @property int $documento
 * @property int $dv
 * @property string $telefono
 * @property string $direccion
 * @property int $descuento
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 * @property bool $estado
 */
class Camarero extends Entity
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
