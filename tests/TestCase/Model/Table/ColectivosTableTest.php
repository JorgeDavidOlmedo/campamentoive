<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ColectivosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ColectivosTable Test Case
 */
class ColectivosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ColectivosTable
     */
    public $Colectivos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.colectivos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Colectivos') ? [] : ['className' => 'App\Model\Table\ColectivosTable'];
        $this->Colectivos = TableRegistry::get('Colectivos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Colectivos);

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
