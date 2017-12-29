<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetallesPedidosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetallesPedidosTable Test Case
 */
class DetallesPedidosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetallesPedidosTable
     */
    public $DetallesPedidos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalles_pedidos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DetallesPedidos') ? [] : ['className' => 'App\Model\Table\DetallesPedidosTable'];
        $this->DetallesPedidos = TableRegistry::get('DetallesPedidos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetallesPedidos);

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
