<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PostulantesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PostulantesTable Test Case
 */
class PostulantesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PostulantesTable
     */
    protected $Postulantes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Postulantes',
        'app.Documentos',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Postulantes') ? [] : ['className' => PostulantesTable::class];
        $this->Postulantes = $this->getTableLocator()->get('Postulantes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Postulantes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\PostulantesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
