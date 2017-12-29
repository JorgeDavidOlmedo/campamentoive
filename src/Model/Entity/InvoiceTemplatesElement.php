<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * InvoiceTemplatesElement Entity
 *
 * @property int $id
 * @property int $invoice_template_id
 * @property string $name
 * @property string $model
 * @property int $p_top
 * @property int $p_left
 * @property int $width
 * @property int $height
 *
 * @property \App\Model\Entity\InvoiceTemplate $invoice_template
 */
class InvoiceTemplatesElement extends Entity
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
