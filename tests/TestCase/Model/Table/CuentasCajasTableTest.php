<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CuentasCajasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CuentasCajasTable Test Case
 */
class CuentasCajasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CuentasCajasTable
     */
    public $CuentasCajas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
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
        $config = TableRegistry::exists('CuentasCajas') ? [] : ['className' => 'App\Model\Table\CuentasCajasTable'];
        $this->CuentasCajas = TableRegistry::get('CuentasCajas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CuentasCajas);

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
