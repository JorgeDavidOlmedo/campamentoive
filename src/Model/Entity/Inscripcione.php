<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Inscripcione Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $fecha
 * @property int $id_persona
 * @property int $id_colectivo
 * @property float $pago
 * @property float $deuda
 * @property string $tipo
 * @property string $observacion
 * @property \Cake\I18n\Time $fecha_cierre
 * @property int $estado
 */
class Inscripcione extends Entity
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
