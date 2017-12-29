<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Timbrado Entity
 *
 * @property int $id
 * @property int $id_empresa
 * @property string $documento
 * @property \Cake\I18n\Time $fecha_inicio
 * @property \Cake\I18n\Time $fecha_fin
 * @property int $aviso_en_dias
 * @property int $estado
 */
class Timbrado extends Entity
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
