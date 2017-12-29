<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetallesCajasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetallesCajasTable Test Case
 */
class DetallesCajasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetallesCajasTable
     */
    public $DetallesCajas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalles_cajas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DetallesCajas') ? [] : ['className' => 'App\Model\Table\DetallesCajasTable'];
        $this->DetallesCajas = TableRegistry::get('DetallesCajas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetallesCajas);

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
