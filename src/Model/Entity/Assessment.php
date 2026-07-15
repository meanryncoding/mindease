<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Assessment Entity
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $phq9_score
 * @property int|null $gad7_score
 * @property int|null $pss4_score
 * @property string|null $depression_level
 * @property string|null $anxiety_level
 * @property string|null $stress_level
 * @property string|null $overall_risk
 * @property int|null $is_flagged
 * @property int|null $crisis_trigger
 * @property int|null $status
 * @property \Cake\I18n\DateTime|null $submitted_at
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\CounselorNote[] $counselor_notes
 * @property \App\Model\Entity\Response[] $responses
 */
class Assessment extends Entity
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
        'user_id' => true,
        'phq9_score' => true,
        'gad7_score' => true,
        'pss4_score' => true,
        'depression_level' => true,
        'anxiety_level' => true,
        'stress_level' => true,
        'overall_risk' => true,
        'is_flagged' => true,
        'crisis_trigger' => true,
        'status' => true,
        'submitted_at' => true,
        'user' => true,
        'counselor_notes' => true,
        'responses' => true,
    ];
}
