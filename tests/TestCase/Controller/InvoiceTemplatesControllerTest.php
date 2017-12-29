<?php
namespace App\Test\TestCase\Controller;

use App\Controller\InvoiceTemplatesController;
use Cake\TestSuite\IntegrationTestCase;

/**
 * App\Controller\InvoiceTemplatesController Test Case
 */
class InvoiceTemplatesControllerTest extends IntegrationTestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.invoice_templates',
        'app.invoice_templates_element',
        'app.empresas',
        'app.usuarios',
        'app.usuarios_empresas',
        'app.perfil',
        'app.detalle_perfil',
        'app.models',
        'app.locales',
        'app.clientes',
        'app.proveedores',
        'app.camareros',
        'app.cuentas_cajas'
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
