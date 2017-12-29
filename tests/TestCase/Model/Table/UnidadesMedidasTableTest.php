<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UnidadesMedidasTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UnidadesMedidasTable Test Case
 */
class UnidadesMedidasTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UnidadesMedidasTable
     */
    public $UnidadesMedidas;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.unidades_medidas'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UnidadesMedidas') ? [] : ['className' => 'App\Model\Table\UnidadesMedidasTable'];
        $this->UnidadesMedidas = TableRegistry::get('UnidadesMedidas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UnidadesMedidas);

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
