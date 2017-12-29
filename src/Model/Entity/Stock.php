<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Stock Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $fecha
 * @property int $id_empresa
 * @property int $id_compra
 * @property int $id_venta
 * @property float $precio_compra
 * @property float $precio_venta
 * @property int $id_proveedor
 * @property int $id_cliente
 * @property int $id_producto
 * @property float $entrada
 * @property float $salida
 * @property int $estado
 *
 * @property \App\Model\Entity\Compra $compra
 * @property \App\Model\Entity\Producto $producto
 * @property \App\Model\Entity\Deposito $deposito
 * @property \App\Model\Entity\Locale $locale
 */
class Stock extends Entity
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
