<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CobrosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CobrosTable Test Case
 */
class CobrosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CobrosTable
     */
    public $Cobros;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cobros'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Cobros') ? [] : ['className' => 'App\Model\Table\CobrosTable'];
        $this->Cobros = TableRegistry::get('Cobros', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cobros);

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
