<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Question Entity
 *
 * @property int $id
 * @property string $section
 * @property string $question_code
 * @property string $question_text
 * @property string $response_type
 * @property int $max_score
 * @property int|null $is_crisis_trigger
 * @property int $order_num
 * @property int|null $status
 *
 * @property \App\Model\Entity\Response[] $responses
 */
class Question extends Entity
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
        'section' => true,
        'question_code' => true,
        'question_text' => true,
        'response_type' => true,
        'max_score' => true,
        'is_crisis_trigger' => true,
        'order_num' => true,
        'status' => true,
        'responses' => true,
    ];
}
