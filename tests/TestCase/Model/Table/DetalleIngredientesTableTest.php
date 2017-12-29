<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetalleIngredientesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetalleIngredientesTable Test Case
 */
class DetalleIngredientesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetalleIngredientesTable
     */
    public $DetalleIngredientes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalle_ingredientes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DetalleIngredientes') ? [] : ['className' => 'App\Model\Table\DetalleIngredientesTable'];
        $this->DetalleIngredientes = TableRegistry::get('DetalleIngredientes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetalleIngredientes);

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
