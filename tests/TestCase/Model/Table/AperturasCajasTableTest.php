<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AperturasCajasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AperturasCajasTable Test Case
 */
class AperturasCajasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AperturasCajasTable
     */
    public $AperturasCajas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.aperturas_cajas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AperturasCajas') ? [] : ['className' => 'App\Model\Table\AperturasCajasTable'];
        $this->AperturasCajas = TableRegistry::get('AperturasCajas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AperturasCajas);

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
