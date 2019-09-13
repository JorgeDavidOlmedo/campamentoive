<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InscripcionesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InscripcionesTable Test Case
 */
class InscripcionesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InscripcionesTable
     */
    public $Inscripciones;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.inscripciones'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Inscripciones') ? [] : ['className' => 'App\Model\Table\InscripcionesTable'];
        $this->Inscripciones = TableRegistry::get('Inscripciones', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Inscripciones);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
