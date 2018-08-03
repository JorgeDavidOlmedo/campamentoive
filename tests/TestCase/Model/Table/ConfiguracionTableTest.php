<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConfiguracionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConfiguracionTable Test Case
 */
class ConfiguracionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConfiguracionTable
     */
    public $Configuracion;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.configuracion'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Configuracion') ? [] : ['className' => 'App\Model\Table\ConfiguracionTable'];
        $this->Configuracion = TableRegistry::get('Configuracion', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Configuracion);

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
