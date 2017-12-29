<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DetallesCobrosFixture
 *
 */
class DetallesCobrosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_cobro' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_vencimiento_venta' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'monto' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => '0.00', 'comment' => ''],
        'estado' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_detalles_cobros_1_idx' => ['type' => 'index', 'columns' => ['id_cobro'], 'length' => []],
            'fk_detalles_cobros_2_idx' => ['type' => 'index', 'columns' => ['id_vencimiento_venta'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_detalles_cobros_1' => ['type' => 'foreign', 'columns' => ['id_cobro'], 'references' => ['cobros', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_detalles_cobros_2' => ['type' => 'foreign', 'columns' => ['id_vencimiento_venta'], 'references' => ['vencimientos_ventas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'id_cobro' => 1,
            'id_vencimiento_venta' => 1,
            'monto' => 1.5,
            'estado' => 1
        ],
    ];
}
