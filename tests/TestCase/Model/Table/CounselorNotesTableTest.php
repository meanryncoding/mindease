<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CounselorNotesTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CounselorNotesTable Test Case
 */
class CounselorNotesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CounselorNotesTable
     */
    protected $CounselorNotes;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected array $fixtures = [
        'app.CounselorNotes',
        'app.Assessments',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('CounselorNotes') ? [] : ['className' => CounselorNotesTable::class];
        $this->CounselorNotes = $this->getTableLocator()->get('CounselorNotes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->CounselorNotes);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CounselorNotesTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     * @uses \App\Model\Table\CounselorNotesTable::buildRules()
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
