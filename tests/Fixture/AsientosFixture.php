<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AsientosFixture
 *
 */
class AsientosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'fecha' => ['type' => 'date', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'documento' => ['type' => 'string', 'length' => 80, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'tipo_movimiento' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => 'asiento', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'id_empresa' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_cliente_proveedor' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'descripcion' => ['type' => 'text', 'length' => 4294967295, 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'id_cuenta_exenta' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_cuenta_5' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_cuenta_10' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'condicion' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => 'contado', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'tipo_compra' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => 'directa', 'collate' => 'latin1_swedish_ci', 'comment' => '', 'precision' => null],
        'id_compra' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'periodo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_venta' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_cobro' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_pago' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tipo_cambio' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '1.00', 'comment' => ''],
        'exenta' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => ''],
        'gravada_5' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => ''],
        'gravada_10' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => ''],
        'iva_5' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => ''],
        'iva_10' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => ''],
        'total' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => false, 'default' => '0.00', 'comment' => ''],
        'estado' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'id_empresa' => ['type' => 'index', 'columns' => ['id_empresa'], 'length' => []],
            'id_cliente_proveedor' => ['type' => 'index', 'columns' => ['id_cliente_proveedor'], 'length' => []],
            'id_compra' => ['type' => 'index', 'columns' => ['id_compra'], 'length' => []],
            'id_venta' => ['type' => 'index', 'columns' => ['id_venta'], 'length' => []],
            'id_cobro' => ['type' => 'index', 'columns' => ['id_cobro'], 'length' => []],
            'id_pago' => ['type' => 'index', 'columns' => ['id_pago'], 'length' => []],
            'id_cuenta_exenta' => ['type' => 'index', 'columns' => ['id_cuenta_exenta'], 'length' => []],
            'id_cuenta_5' => ['type' => 'index', 'columns' => ['id_cuenta_5'], 'length' => []],
            'asientos_ibfk_10' => ['type' => 'index', 'columns' => ['id_cuenta_10'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'asientos_ibfk_10' => ['type' => 'foreign', 'columns' => ['id_cuenta_10'], 'references' => ['plan_de_cuentas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'asientos_ibfk_1' => ['type' => 'foreign', 'columns' => ['id_empresa'], 'references' => ['empresas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'asientos_ibfk_2' => ['type' => 'foreign', 'columns' => ['id_cliente_proveedor'], 'references' => ['clientes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'asientos_ibfk_3' => ['type' => 'foreign', 'columns' => ['id_cliente_proveedor'], 'references' => ['proveedores', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'asientos_ibfk_4' => ['type' => 'foreign', 'columns' => ['id_compra'], 'references' => ['compras', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'asientos_ibfk_5' => ['type' => 'foreign', 'columns' => ['id_venta'], 'references' => ['ventas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'asientos_ibfk_6' => ['type' => 'foreign', 'columns' => ['id_cobro'], 'references' => ['cobros', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'asientos_ibfk_7' => ['type' => 'foreign', 'columns' => ['id_pago'], 'references' => ['pagos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'asientos_ibfk_8' => ['type' => 'foreign', 'columns' => ['id_cuenta_exenta'], 'references' => ['plan_de_cuentas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'asientos_ibfk_9' => ['type' => 'foreign', 'columns' => ['id_cuenta_5'], 'references' => ['plan_de_cuentas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'latin1_swedish_ci'
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
            'fecha' => '2017-07-24',
            'documento' => 'Lorem ipsum dolor sit amet',
            'tipo_movimiento' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'id_empresa' => 1,
            'id_cliente_proveedor' => 1,
            'descripcion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'id_cuenta_exenta' => 1,
            'id_cuenta_5' => 1,
            'id_cuenta_10' => 1,
            'condicion' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'tipo_compra' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'id_compra' => 1,
            'periodo' => 1,
            'id_venta' => 1,
            'id_cobro' => 1,
            'id_pago' => 1,
            'tipo_cambio' => 1.5,
            'exenta' => 1.5,
            'gravada_5' => 1.5,
            'gravada_10' => 1.5,
            'iva_5' => 1.5,
            'iva_10' => 1.5,
            'total' => 1.5,
            'estado' => 1
        ],
    ];
}
