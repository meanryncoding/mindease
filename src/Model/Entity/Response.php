<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Response Entity
 *
 * @property int $id
 * @property int $assessment_id
 * @property int $question_id
 * @property int|null $response_value
 * @property string|null $response_text
 * @property int|null $status
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\Assessment $assessment
 * @property \App\Model\Entity\Question $question
 */
class Response extends Entity
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
        'question_id' => true,
        'response_value' => true,
        'response_text' => true,
        'status' => true,
        'created_at' => true,
        'assessment' => true,
        'question' => true,
    ];
}
