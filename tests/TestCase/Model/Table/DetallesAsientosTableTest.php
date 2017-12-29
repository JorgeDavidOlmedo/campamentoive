<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetallesAsientosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetallesAsientosTable Test Case
 */
class DetallesAsientosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetallesAsientosTable
     */
    public $DetallesAsientos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalles_asientos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DetallesAsientos') ? [] : ['className' => 'App\Model\Table\DetallesAsientosTable'];
        $this->DetallesAsientos = TableRegistry::get('DetallesAsientos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetallesAsientos);

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
