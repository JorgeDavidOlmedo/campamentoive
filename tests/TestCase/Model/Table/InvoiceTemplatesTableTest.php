<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoiceTemplatesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvoiceTemplatesTable Test Case
 */
class InvoiceTemplatesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InvoiceTemplatesTable
     */
    public $InvoiceTemplates;

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
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('InvoiceTemplates') ? [] : ['className' => 'App\Model\Table\InvoiceTemplatesTable'];
        $this->InvoiceTemplates = TableRegistry::get('InvoiceTemplates', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InvoiceTemplates);

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
