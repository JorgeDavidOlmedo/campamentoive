<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AnticipoClientesFixture
 *
 */
class AnticipoClientesFixture extends TestFixture
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
        'id_cobro' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'fecha' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'documento' => ['type' => 'string', 'length' => 80, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'id_moneda' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tipo_cambio' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => '1.00', 'comment' => ''],
        'id_cliente' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'monto' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'monto_utilizado' => ['type' => 'decimal', 'length' => 16, 'precision' => 2, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => ''],
        'estado' => ['type' => 'integer', 'length' => 4, 'unsigned' => false, 'null' => false, 'default' => '1', 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_anticipo_clientes_1_idx' => ['type' => 'index', 'columns' => ['id_moneda'], 'length' => []],
            'fk_anticipo_clientes_2_idx' => ['type' => 'index', 'columns' => ['id_cliente'], 'length' => []],
            'fk_anticipo_clientes_3_idx' => ['type' => 'index', 'columns' => ['id_cobro'], 'length' => []],
            'fk_anticipo_clientes_4_idx' => ['type' => 'index', 'columns' => ['id_empresa'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_anticipo_clientes_3' => ['type' => 'foreign', 'columns' => ['id_cobro'], 'references' => ['cobros', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_anticipo_clientes_4' => ['type' => 'foreign', 'columns' => ['id_empresa'], 'references' => ['empresas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_anticipo_clientes_1' => ['type' => 'foreign', 'columns' => ['id_moneda'], 'references' => ['monedas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_anticipo_clientes_2' => ['type' => 'foreign', 'columns' => ['id_cliente'], 'references' => ['clientes', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'id_cobro' => 1,
            'fecha' => '2017-02-28',
            'documento' => 'Lorem ipsum dolor sit amet',
            'id_moneda' => 1,
            'tipo_cambio' => 1.5,
            'id_cliente' => 1,
            'monto' => 1.5,
            'monto_utilizado' => 1.5,
            'estado' => 1
        ],
    ];
}
