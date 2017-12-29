<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DetalleTransferenciaStockFixture
 *
 */
class DetalleTransferenciaStockFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'detalle_transferencia_stock';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_transferencia_stock' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_producto' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'cantidad' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => '0.00', 'comment' => ''],
        'estado' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_detalle_transferencia_stock_1_idx' => ['type' => 'index', 'columns' => ['id_transferencia_stock'], 'length' => []],
            'fk_detalle_transferencia_stock_2_idx' => ['type' => 'index', 'columns' => ['id_producto'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_detalle_transferencia_stock_1' => ['type' => 'foreign', 'columns' => ['id_transferencia_stock'], 'references' => ['transferencia_stock', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_detalle_transferencia_stock_2' => ['type' => 'foreign', 'columns' => ['id_producto'], 'references' => ['productos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'id_transferencia_stock' => 1,
            'id_producto' => 1,
            'cantidad' => 1.5,
            'estado' => 1
        ],
    ];
}
