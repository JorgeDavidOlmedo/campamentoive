<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetallesVentasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetallesVentasTable Test Case
 */
class DetallesVentasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetallesVentasTable
     */
    public $DetallesVentas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalles_ventas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DetallesVentas') ? [] : ['className' => 'App\Model\Table\DetallesVentasTable'];
        $this->DetallesVentas = TableRegistry::get('DetallesVentas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetallesVentas);

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
