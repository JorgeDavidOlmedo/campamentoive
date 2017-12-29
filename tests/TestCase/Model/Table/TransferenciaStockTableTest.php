<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TransferenciaStockTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TransferenciaStockTable Test Case
 */
class TransferenciaStockTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TransferenciaStockTable
     */
    public $TransferenciaStock;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.transferencia_stock'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TransferenciaStock') ? [] : ['className' => 'App\Model\Table\TransferenciaStockTable'];
        $this->TransferenciaStock = TableRegistry::get('TransferenciaStock', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TransferenciaStock);

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
