<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UuidTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UuidTable Test Case
 */
class UuidTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UuidTable
     */
    public $Uuid;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.uuid'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Uuid') ? [] : ['className' => 'App\Model\Table\UuidTable'];
        $this->Uuid = TableRegistry::get('Uuid', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Uuid);

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
