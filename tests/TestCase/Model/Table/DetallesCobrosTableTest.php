<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetallesCobrosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetallesCobrosTable Test Case
 */
class DetallesCobrosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetallesCobrosTable
     */
    public $DetallesCobros;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalles_cobros'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DetallesCobros') ? [] : ['className' => 'App\Model\Table\DetallesCobrosTable'];
        $this->DetallesCobros = TableRegistry::get('DetallesCobros', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetallesCobros);

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
