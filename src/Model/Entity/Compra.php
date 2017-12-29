<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Compra Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $fecha
 * @property int $id_empresa
 * @property int $id_proveedor
 * @property string $documento
 * @property string $timbrado
 * @property string $condicion
 * @property string $clasificacion
 * @property string $estado_pago
 * @property float $total
 * @property int $estado
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Compra extends Entity
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
