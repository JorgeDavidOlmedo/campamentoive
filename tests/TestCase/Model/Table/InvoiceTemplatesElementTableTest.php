<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\InvoiceTemplatesElementTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\InvoiceTemplatesElementTable Test Case
 */
class InvoiceTemplatesElementTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\InvoiceTemplatesElementTable
     */
    public $InvoiceTemplatesElement;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.invoice_templates_element',
        'app.invoice_templates',
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
        $config = TableRegistry::exists('InvoiceTemplatesElement') ? [] : ['className' => 'App\Model\Table\InvoiceTemplatesElementTable'];
        $this->InvoiceTemplatesElement = TableRegistry::get('InvoiceTemplatesElement', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->InvoiceTemplatesElement);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
