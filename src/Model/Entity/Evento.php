<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Evento Entity
 *
 * @property int $id
 * @property \Cake\I18n\Time $fecha
 * @property int $cupo_participante
 * @property float $costo_participante
 * @property int $cupo_voluntario
 * @property float $costo_voluntario
 * @property int $cupo_colaborador
 * @property float $costo_colaborador
 * @property string $descripcion
 * @property float $costo
 * @property int $estado
 */
class Evento extends Entity
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
