<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ProyectosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ProyectosTable Test Case
 */
class ProyectosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\ProyectosTable
     */
    protected $Proyectos;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Proyectos',
        'app.Postulantes',
        'app.Documentos',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Proyectos') ? [] : ['className' => ProyectosTable::class];
        $this->Proyectos = $this->getTableLocator()->get('Proyectos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Proyectos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\ProyectosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\ProyectosTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
