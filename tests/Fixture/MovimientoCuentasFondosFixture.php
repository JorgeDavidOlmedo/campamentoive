<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * MovimientoCuentasFondosFixture
 *
 */
class MovimientoCuentasFondosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_empresa' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_cuenta_fondo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_caja' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'nro_cheque' => ['type' => 'string', 'length' => 90, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'id_banco' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'descrip_banco' => ['type' => 'string', 'length' => 80, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'nro_vaucher' => ['type' => 'string', 'length' => 90, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'fecha' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'debe' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => '0.00', 'comment' => ''],
        'haber' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => '0.00', 'comment' => ''],
        'estado' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => true, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_movimiento_cuentas_fondos_1_idx' => ['type' => 'index', 'columns' => ['id_cuenta_fondo'], 'length' => []],
            'fk_movimiento_cuentas_fondos_2_idx' => ['type' => 'index', 'columns' => ['id_empresa'], 'length' => []],
            'fk_movimiento_cuentas_fondos_6_idx' => ['type' => 'index', 'columns' => ['id_caja'], 'length' => []],
            'fk_movimiento_cuentas_fondos_7_idx' => ['type' => 'index', 'columns' => ['id_banco'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'movimiento_cuentas_fondos_ibfk_1' => ['type' => 'foreign', 'columns' => ['id_banco'], 'references' => ['bancos', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'movimiento_cuentas_fondos_ibfk_2' => ['type' => 'foreign', 'columns' => ['id_empresa'], 'references' => ['empresas', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'movimiento_cuentas_fondos_ibfk_3' => ['type' => 'foreign', 'columns' => ['id_caja'], 'references' => ['cajas', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'id_empresa' => 1,
            'id_cuenta_fondo' => 1,
            'id_caja' => 1,
            'nro_cheque' => 'Lorem ipsum dolor sit amet',
            'id_banco' => 1,
            'descrip_banco' => 'Lorem ipsum dolor sit amet',
            'nro_vaucher' => 'Lorem ipsum dolor sit amet',
            'fecha' => '2017-11-30',
            'debe' => 1.5,
            'haber' => 1.5,
            'estado' => 1
        ],
    ];
}
