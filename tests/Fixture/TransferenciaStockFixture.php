<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * TransferenciaStockFixture
 *
 */
class TransferenciaStockFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'transferencia_stock';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_empresa' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_deposito_origen' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_deposito_destino' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'fecha' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        'nro_documento' => ['type' => 'string', 'length' => 90, 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'estado' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'fk_transferencia_stock_1_idx' => ['type' => 'index', 'columns' => ['id_empresa'], 'length' => []],
            'fk_transferencia_stock_2_idx' => ['type' => 'index', 'columns' => ['id_deposito_origen'], 'length' => []],
            'fk_transferencia_stock_3_idx' => ['type' => 'index', 'columns' => ['id_deposito_destino'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_transferencia_stock_1' => ['type' => 'foreign', 'columns' => ['id_empresa'], 'references' => ['empresas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_transferencia_stock_2' => ['type' => 'foreign', 'columns' => ['id_deposito_origen'], 'references' => ['depositos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_transferencia_stock_3' => ['type' => 'foreign', 'columns' => ['id_deposito_destino'], 'references' => ['depositos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'id_deposito_origen' => 1,
            'id_deposito_destino' => 1,
            'fecha' => '2017-03-04',
            'nro_documento' => 'Lorem ipsum dolor sit amet',
            'estado' => 1
        ],
    ];
}
