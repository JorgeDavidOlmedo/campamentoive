<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AsientosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AsientosTable Test Case
 */
class AsientosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AsientosTable
     */
    public $Asientos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.asientos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Asientos') ? [] : ['className' => 'App\Model\Table\AsientosTable'];
        $this->Asientos = TableRegistry::get('Asientos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Asientos);

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
