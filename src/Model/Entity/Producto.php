<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Producto Entity
 *
 * @property int $id
 * @property string $descripcion
 * @property int $id_empresa
 * @property int $id_grupo
 * @property int $id_unidad
 * @property float $precio_costo
 * @property float $precio_venta
 * @property float $precio_medio
 * @property int $stock_minimo
 * @property int $tipo_producto
 * @property string $estado
 * @property string $regimen_turismo
 * @property \Cake\I18n\Time $created
 * @property \Cake\I18n\Time $modified
 */
class Producto extends Entity
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
