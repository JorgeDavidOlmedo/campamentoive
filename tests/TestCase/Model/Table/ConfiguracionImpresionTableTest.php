<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ConfiguracionImpresionTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ConfiguracionImpresionTable Test Case
 */
class ConfiguracionImpresionTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ConfiguracionImpresionTable
     */
    public $ConfiguracionImpresion;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.configuracion_impresion'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('ConfiguracionImpresion') ? [] : ['className' => 'App\Model\Table\ConfiguracionImpresionTable'];
        $this->ConfiguracionImpresion = TableRegistry::get('ConfiguracionImpresion', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->ConfiguracionImpresion);

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
