<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnticipoClientesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnticipoClientesTable Test Case
 */
class AnticipoClientesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AnticipoClientesTable
     */
    public $AnticipoClientes;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.anticipo_clientes'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AnticipoClientes') ? [] : ['className' => 'App\Model\Table\AnticipoClientesTable'];
        $this->AnticipoClientes = TableRegistry::get('AnticipoClientes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AnticipoClientes);

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
