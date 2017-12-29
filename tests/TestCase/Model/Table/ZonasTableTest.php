<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ZonasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ZonasTable Test Case
 */
class ZonasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ZonasTable
     */
    public $Zonas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.zonas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Zonas') ? [] : ['className' => 'App\Model\Table\ZonasTable'];
        $this->Zonas = TableRegistry::get('Zonas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Zonas);

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
