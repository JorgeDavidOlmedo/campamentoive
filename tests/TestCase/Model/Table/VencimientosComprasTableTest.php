<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VencimientosComprasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VencimientosComprasTable Test Case
 */
class VencimientosComprasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VencimientosComprasTable
     */
    public $VencimientosCompras;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vencimientos_compras'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VencimientosCompras') ? [] : ['className' => 'App\Model\Table\VencimientosComprasTable'];
        $this->VencimientosCompras = TableRegistry::get('VencimientosCompras', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VencimientosCompras);

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
