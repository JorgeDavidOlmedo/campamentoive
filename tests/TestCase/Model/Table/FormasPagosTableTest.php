<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormasPagosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormasPagosTable Test Case
 */
class FormasPagosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FormasPagosTable
     */
    public $FormasPagos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.formas_pagos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('FormasPagos') ? [] : ['className' => 'App\Model\Table\FormasPagosTable'];
        $this->FormasPagos = TableRegistry::get('FormasPagos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->FormasPagos);

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
