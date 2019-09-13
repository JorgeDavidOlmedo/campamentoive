<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CargarColectivosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CargarColectivosTable Test Case
 */
class CargarColectivosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CargarColectivosTable
     */
    public $CargarColectivos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cargar_colectivos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CargarColectivos') ? [] : ['className' => 'App\Model\Table\CargarColectivosTable'];
        $this->CargarColectivos = TableRegistry::get('CargarColectivos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CargarColectivos);

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
