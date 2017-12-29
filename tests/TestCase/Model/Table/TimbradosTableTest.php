<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TimbradosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TimbradosTable Test Case
 */
class TimbradosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TimbradosTable
     */
    public $Timbrados;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.timbrados'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Timbrados') ? [] : ['className' => 'App\Model\Table\TimbradosTable'];
        $this->Timbrados = TableRegistry::get('Timbrados', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Timbrados);

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
