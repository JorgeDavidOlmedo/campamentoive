<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetallePerfilTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetallePerfilTable Test Case
 */
class DetallePerfilTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetallePerfilTable
     */
    public $DetallePerfil;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalle_perfil'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DetallePerfil') ? [] : ['className' => 'App\Model\Table\DetallePerfilTable'];
        $this->DetallePerfil = TableRegistry::get('DetallePerfil', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetallePerfil);

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
