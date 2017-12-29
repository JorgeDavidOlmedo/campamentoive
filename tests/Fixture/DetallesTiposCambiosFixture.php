<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * DetallesTiposCambiosFixture
 *
 */
class DetallesTiposCambiosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_tipo_cambio' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_moneda' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'compra' => ['type' => 'decimal', 'length' => 16, 'precision' => 6, 'unsigned' => false, 'null' => true, 'default' => '0.000000', 'comment' => ''],
        'venta' => ['type' => 'decimal', 'length' => 16, 'precision' => 6, 'unsigned' => false, 'null' => true, 'default' => '0.000000', 'comment' => ''],
        '_indexes' => [
            'fk_detalles_tipos_cambios_1_idx' => ['type' => 'index', 'columns' => ['id_tipo_cambio'], 'length' => []],
            'fk_detalles_tipos_cambios_2_idx' => ['type' => 'index', 'columns' => ['id_moneda'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_detalles_tipos_cambios_1' => ['type' => 'foreign', 'columns' => ['id_tipo_cambio'], 'references' => ['tipos_cambios', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_detalles_tipos_cambios_2' => ['type' => 'foreign', 'columns' => ['id_moneda'], 'references' => ['monedas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'id_tipo_cambio' => 1,
            'id_moneda' => 1,
            'compra' => 1.5,
            'venta' => 1.5
        ],
    ];
}
