<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CentroCostosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CentroCostosTable Test Case
 */
class CentroCostosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CentroCostosTable
     */
    public $CentroCostos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.centro_costos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('CentroCostos') ? [] : ['className' => 'App\Model\Table\CentroCostosTable'];
        $this->CentroCostos = TableRegistry::get('CentroCostos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->CentroCostos);

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
