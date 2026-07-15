<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ResponsesFixture
 */
class ResponsesFixture extends TestFixture
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
                'assessment_id' => 1,
                'question_id' => 1,
                'response_value' => 1,
                'response_text' => 'Lorem ipsum dolor sit amet',
                'status' => 1,
                'created_at' => '2026-06-20 19:06:55',
            ],
        ];
        parent::init();
    }
}
