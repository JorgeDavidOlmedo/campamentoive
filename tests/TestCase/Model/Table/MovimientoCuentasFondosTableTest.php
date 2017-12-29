<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MovimientoCuentasFondosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MovimientoCuentasFondosTable Test Case
 */
class MovimientoCuentasFondosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MovimientoCuentasFondosTable
     */
    public $MovimientoCuentasFondos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.movimiento_cuentas_fondos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MovimientoCuentasFondos') ? [] : ['className' => 'App\Model\Table\MovimientoCuentasFondosTable'];
        $this->MovimientoCuentasFondos = TableRegistry::get('MovimientoCuentasFondos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MovimientoCuentasFondos);

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
