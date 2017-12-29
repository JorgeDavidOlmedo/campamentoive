<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\VencimientosVentasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\VencimientosVentasTable Test Case
 */
class VencimientosVentasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\VencimientosVentasTable
     */
    public $VencimientosVentas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.vencimientos_ventas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('VencimientosVentas') ? [] : ['className' => 'App\Model\Table\VencimientosVentasTable'];
        $this->VencimientosVentas = TableRegistry::get('VencimientosVentas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->VencimientosVentas);

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
