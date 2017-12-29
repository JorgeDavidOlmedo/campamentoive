<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CuentasFondosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CuentasFondosTable Test Case
 */
class CuentasFondosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CuentasFondosTable
     */
    public $CuentasFondos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cuentas_fondos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CuentasFondos') ? [] : ['className' => 'App\Model\Table\CuentasFondosTable'];
        $this->CuentasFondos = TableRegistry::get('CuentasFondos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CuentasFondos);

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
