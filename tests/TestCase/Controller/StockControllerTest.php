<?php
namespace App\Test\TestCase\Controller;

use App\Controller\StockController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\StockController Test Case
 */
class StockControllerTest extends IntegrationTestCase
{

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
     * Test index method
     *
     * @return void
     */
    public function testIndex()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test view method
     *
     * @return void
     */
    public function testView()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test add method
     *
     * @return void
     */
    public function testAdd()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test edit method
     *
     * @return void
     */
    public function testEdit()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test delete method
     *
     * @return void
     */
    public function testDelete()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
