<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DetallesPagosTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DetallesPagosTable Test Case
 */
class DetallesPagosTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DetallesPagosTable
     */
    public $DetallesPagos;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.detalles_pagos'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('DetallesPagos') ? [] : ['className' => 'App\Model\Table\DetallesPagosTable'];
        $this->DetallesPagos = TableRegistry::get('DetallesPagos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->DetallesPagos);

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
