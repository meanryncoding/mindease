<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CounselorNotesFixture
 */
class CounselorNotesFixture extends TestFixture
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
                'counselor_id' => 1,
                'clinical_note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'action_taken' => 'Lorem ipsum dolor sit amet',
                'follow_up_date' => '2026-06-20',
                'status' => 1,
                'created_at' => '2026-06-20 19:12:57',
            ],
        ];
        parent::init();
    }
}
