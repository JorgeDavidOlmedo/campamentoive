<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StockTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StockTable Test Case
 */
class StockTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\StockTable
     */
    public $Stock;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.stock',
        'app.compras',
        'app.productos',
        'app.categorias',
        'app.empresas',
        'app.usuarios',
        'app.usuarios_empresas',
        'app.perfil',
        'app.detalle_perfil',
        'app.models',
        'app.locales',
        'app.depositos',
        'app.cuentas_fondos',
        'app.plan_de_cuentas',
        'app.ingredientes',
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
        $config = TableRegistry::exists('Stock') ? [] : ['className' => 'App\Model\Table\StockTable'];
        $this->Stock = TableRegistry::get('Stock', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Stock);

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
