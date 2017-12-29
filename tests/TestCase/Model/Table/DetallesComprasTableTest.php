<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetallesComprasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetallesComprasTable Test Case
 */
class DetallesComprasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetallesComprasTable
     */
    public $DetallesCompras;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalles_compras'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DetallesCompras') ? [] : ['className' => 'App\Model\Table\DetallesComprasTable'];
        $this->DetallesCompras = TableRegistry::get('DetallesCompras', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetallesCompras);

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
