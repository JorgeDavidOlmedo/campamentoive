<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PlanDeCuentasStandarTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PlanDeCuentasStandarTable Test Case
 */
class PlanDeCuentasStandarTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\PlanDeCuentasStandarTable
     */
    public $PlanDeCuentasStandar;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.plan_de_cuentas_standar'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('PlanDeCuentasStandar') ? [] : ['className' => 'App\Model\Table\PlanDeCuentasStandarTable'];
        $this->PlanDeCuentasStandar = TableRegistry::get('PlanDeCuentasStandar', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->PlanDeCuentasStandar);

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
