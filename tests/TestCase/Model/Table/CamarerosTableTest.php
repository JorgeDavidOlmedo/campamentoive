<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CamarerosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CamarerosTable Test Case
 */
class CamarerosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CamarerosTable
     */
    public $Camareros;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.camareros'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Camareros') ? [] : ['className' => 'App\Model\Table\CamarerosTable'];
        $this->Camareros = TableRegistry::get('Camareros', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Camareros);

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

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
