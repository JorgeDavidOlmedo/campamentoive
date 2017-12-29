<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\TiposCambiosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\TiposCambiosTable Test Case
 */
class TiposCambiosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\TiposCambiosTable
     */
    public $TiposCambios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.tipos_cambios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('TiposCambios') ? [] : ['className' => 'App\Model\Table\TiposCambiosTable'];
        $this->TiposCambios = TableRegistry::get('TiposCambios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->TiposCambios);

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
