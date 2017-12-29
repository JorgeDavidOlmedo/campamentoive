<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DetalleIngrediente Entity
 *
 * @property int $id
 * @property int $id_ingrediente
 * @property int $id_producto
 * @property string $unidad_medida
 * @property int $cantidad
 * @property int $estado
 */
class DetalleIngrediente extends Entity
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
