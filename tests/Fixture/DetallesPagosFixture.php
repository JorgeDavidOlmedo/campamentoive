<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DetallesPagosFixture
 *
 */
class DetallesPagosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_pago' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_vencimiento_compra' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'monto' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => '0.00', 'comment' => ''],
        'estado' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_detalles_pagos_1_idx' => ['type' => 'index', 'columns' => ['id_pago'], 'length' => []],
            'fk_detalles_pagos_2_idx' => ['type' => 'index', 'columns' => ['id_vencimiento_compra'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_detalles_pagos_1' => ['type' => 'foreign', 'columns' => ['id_pago'], 'references' => ['pagos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_detalles_pagos_2' => ['type' => 'foreign', 'columns' => ['id_vencimiento_compra'], 'references' => ['vencimientos_compras', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'id_pago' => 1,
            'id_vencimiento_compra' => 1,
            'monto' => 1.5,
            'estado' => 1
        ],
    ];
}
