<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetallesTiposCambiosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetallesTiposCambiosTable Test Case
 */
class DetallesTiposCambiosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetallesTiposCambiosTable
     */
    public $DetallesTiposCambios;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalles_tipos_cambios'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DetallesTiposCambios') ? [] : ['className' => 'App\Model\Table\DetallesTiposCambiosTable'];
        $this->DetallesTiposCambios = TableRegistry::get('DetallesTiposCambios', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetallesTiposCambios);

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
