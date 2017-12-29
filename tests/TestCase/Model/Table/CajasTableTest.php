<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CajasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CajasTable Test Case
 */
class CajasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CajasTable
     */
    public $Cajas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.cajas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Cajas') ? [] : ['className' => 'App\Model\Table\CajasTable'];
        $this->Cajas = TableRegistry::get('Cajas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Cajas);

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
