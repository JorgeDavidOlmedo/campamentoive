<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * StockFixture
 *
 */
class StockFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'stock';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'fecha' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'id_empresa' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_compra' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_venta' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'precio_compra' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => '0.00', 'comment' => ''],
        'precio_venta' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'id_proveedor' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_cliente' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_producto' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'entrada' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => '0.00', 'comment' => ''],
        'salida' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => '0.00', 'comment' => ''],
        'estado' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_stock_2_idx' => ['type' => 'index', 'columns' => ['id_proveedor'], 'length' => []],
            'fk_stock_3_idx' => ['type' => 'index', 'columns' => ['id_producto'], 'length' => []],
            'fk_stock_7_idx' => ['type' => 'index', 'columns' => ['id_empresa'], 'length' => []],
            'id_cliente' => ['type' => 'index', 'columns' => ['id_cliente'], 'length' => []],
            'id_compra' => ['type' => 'index', 'columns' => ['id_compra'], 'length' => []],
            'id_venta' => ['type' => 'index', 'columns' => ['id_venta'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'stock_ibfk_1' => ['type' => 'foreign', 'columns' => ['id_empresa'], 'references' => ['empresas', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'stock_ibfk_2' => ['type' => 'foreign', 'columns' => ['id_proveedor'], 'references' => ['proveedores', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'stock_ibfk_3' => ['type' => 'foreign', 'columns' => ['id_cliente'], 'references' => ['clientes', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'stock_ibfk_4' => ['type' => 'foreign', 'columns' => ['id_producto'], 'references' => ['productos', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'stock_ibfk_5' => ['type' => 'foreign', 'columns' => ['id_compra'], 'references' => ['compras', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'stock_ibfk_6' => ['type' => 'foreign', 'columns' => ['id_venta'], 'references' => ['ventas', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'fecha' => '2017-11-24',
            'id_empresa' => 1,
            'id_compra' => 1,
            'id_venta' => 1,
            'precio_compra' => 1.5,
            'precio_venta' => 1.5,
            'id_proveedor' => 1,
            'id_cliente' => 1,
            'id_producto' => 1,
            'entrada' => 1.5,
            'salida' => 1.5,
            'estado' => 1
        ],
    ];
}
