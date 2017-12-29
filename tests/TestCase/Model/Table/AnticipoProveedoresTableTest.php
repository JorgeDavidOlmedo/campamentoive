<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AnticipoProveedoresTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AnticipoProveedoresTable Test Case
 */
class AnticipoProveedoresTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AnticipoProveedoresTable
     */
    public $AnticipoProveedores;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.anticipo_proveedores'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('AnticipoProveedores') ? [] : ['className' => 'App\Model\Table\AnticipoProveedoresTable'];
        $this->AnticipoProveedores = TableRegistry::get('AnticipoProveedores', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->AnticipoProveedores);

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
