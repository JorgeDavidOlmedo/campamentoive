<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetalleTransferenciaStockTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetalleTransferenciaStockTable Test Case
 */
class DetalleTransferenciaStockTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetalleTransferenciaStockTable
     */
    public $DetalleTransferenciaStock;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalle_transferencia_stock'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DetalleTransferenciaStock') ? [] : ['className' => 'App\Model\Table\DetalleTransferenciaStockTable'];
        $this->DetalleTransferenciaStock = TableRegistry::get('DetalleTransferenciaStock', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetalleTransferenciaStock);

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
