<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlanDeCuentasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlanDeCuentasTable Test Case
 */
class PlanDeCuentasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PlanDeCuentasTable
     */
    public $PlanDeCuentas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.plan_de_cuentas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PlanDeCuentas') ? [] : ['className' => 'App\Model\Table\PlanDeCuentasTable'];
        $this->PlanDeCuentas = TableRegistry::get('PlanDeCuentas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PlanDeCuentas);

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
