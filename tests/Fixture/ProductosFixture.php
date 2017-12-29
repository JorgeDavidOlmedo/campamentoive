<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ProductosFixture
 *
 */
class ProductosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'descripcion' => ['type' => 'string', 'length' => 100, 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'id_empresa' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_grupo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_unidad' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'precio_costo' => ['type' => 'decimal', 'length' => 16, 'precision' => 6, 'unsigned' => false, 'null' => true, 'default' => '0.000000', 'comment' => ''],
        'precio_venta' => ['type' => 'decimal', 'length' => 16, 'precision' => 6, 'unsigned' => false, 'null' => true, 'default' => '0.000000', 'comment' => ''],
        'precio_medio' => ['type' => 'decimal', 'length' => 16, 'precision' => 6, 'unsigned' => false, 'null' => true, 'default' => '0.000000', 'comment' => ''],
        'stock_minimo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'tipo_producto' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => true, 'default' => null, 'comment' => '0 - mercaderias
1 - Activo fijo
2 - Gastos', 'precision' => null, 'autoIncrement' => null],
        'estado' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => 'b\'1\'', 'collate' => null, 'comment' => '', 'precision' => null],
        'regimen_turismo' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => 'b\'0\'', 'collate' => null, 'comment' => '', 'precision' => null],
        'created' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'modified' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'CURRENT_TIMESTAMP', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'fk_productos_1_idx' => ['type' => 'index', 'columns' => ['id_empresa'], 'length' => []],
            'fk_productos_2_idx' => ['type' => 'index', 'columns' => ['id_grupo'], 'length' => []],
            'fk_productos_3_idx' => ['type' => 'index', 'columns' => ['id_unidad'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'fk_productos_1' => ['type' => 'foreign', 'columns' => ['id_empresa'], 'references' => ['empresas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_productos_2' => ['type' => 'foreign', 'columns' => ['id_grupo'], 'references' => ['grupos', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'fk_productos_3' => ['type' => 'foreign', 'columns' => ['id_unidad'], 'references' => ['unidades_medidas', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
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
            'descripcion' => 'Lorem ipsum dolor sit amet',
            'id_empresa' => 1,
            'id_grupo' => 1,
            'id_unidad' => 1,
            'precio_costo' => 1.5,
            'precio_venta' => 1.5,
            'precio_medio' => 1.5,
            'stock_minimo' => 1,
            'tipo_producto' => 1,
            'estado' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'regimen_turismo' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'created' => '2017-01-23 13:51:54',
            'modified' => 1485190314
        ],
    ];
}
