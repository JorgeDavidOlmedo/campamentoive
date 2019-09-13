<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EquipoTmpTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EquipoTmpTable Test Case
 */
class EquipoTmpTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\EquipoTmpTable
     */
    public $EquipoTmp;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.equipo_tmp'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('EquipoTmp') ? [] : ['className' => 'App\Model\Table\EquipoTmpTable'];
        $this->EquipoTmp = TableRegistry::get('EquipoTmp', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->EquipoTmp);

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
