<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DocumentosTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DocumentosTable Test Case
 */
class DocumentosTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\DocumentosTable
     */
    protected $Documentos;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Documentos',
        'app.Postulantes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Documentos') ? [] : ['className' => DocumentosTable::class];
        $this->Documentos = $this->getTableLocator()->get('Documentos', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Documentos);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\DocumentosTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\DocumentosTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
