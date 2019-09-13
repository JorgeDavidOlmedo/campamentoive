<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CargarColectivosFixture
 *
 */
class CargarColectivosFixture extends TestFixture
{

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'id_colectivo' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_inscripcion' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'id_evento' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'vaciar' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'comment' => '', 'precision' => null],
        '_indexes' => [
            'id_colectivo' => ['type' => 'index', 'columns' => ['id_colectivo'], 'length' => []],
            'id_inscripcion' => ['type' => 'index', 'columns' => ['id_inscripcion'], 'length' => []],
            'id_evento' => ['type' => 'index', 'columns' => ['id_evento'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'cargar_colectivos_ibfk_1' => ['type' => 'foreign', 'columns' => ['id_colectivo'], 'references' => ['colectivos', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'cargar_colectivos_ibfk_2' => ['type' => 'foreign', 'columns' => ['id_inscripcion'], 'references' => ['inscripciones', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'cargar_colectivos_ibfk_3' => ['type' => 'foreign', 'columns' => ['id_evento'], 'references' => ['eventos', 'id'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'id_colectivo' => 1,
            'id_inscripcion' => 1,
            'id_evento' => 1,
            'vaciar' => '2018-08-23'
        ],
    ];
}
