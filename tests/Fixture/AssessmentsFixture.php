<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AssessmentsFixture
 */
class AssessmentsFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id' => 1,
                'user_id' => 1,
                'phq9_score' => 1,
                'gad7_score' => 1,
                'pss4_score' => 1,
                'depression_level' => 'Lorem ipsum dolor sit amet',
                'anxiety_level' => 'Lorem ipsum dolor sit amet',
                'stress_level' => 'Lorem ipsum dolor sit amet',
                'overall_risk' => 'Lorem ipsum dolor sit amet',
                'is_flagged' => 1,
                'crisis_trigger' => 1,
                'status' => 1,
                'submitted_at' => '2026-06-20 19:03:33',
            ],
        ];
        parent::init();
    }
}
