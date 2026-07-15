<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * CounselorNote Entity
 *
 * @property int $id
 * @property int $assessment_id
 * @property int $counselor_id
 * @property string|null $clinical_note
 * @property string|null $action_taken
 * @property \Cake\I18n\Date|null $follow_up_date
 * @property int|null $status
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\Assessment $assessment
 */
class CounselorNote extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'assessment_id' => true,
        'counselor_id' => true,
        'clinical_note' => true,
        'action_taken' => true,
        'follow_up_date' => true,
        'status' => true,
        'created_at' => true,
        'assessment' => true,
    ];
}
