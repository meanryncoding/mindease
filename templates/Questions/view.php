<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<!--Header-->
<div class="row text-body-secondary">
	<div class="col-10">
		<h1 class="my-0 page_title"><?php echo $title; ?></h1>
		<h6 class="sub_title text-body-secondary"><?php echo $system_name; ?></h6>
	</div>
	<div class="col-2 text-end">
		<div class="dropdown mx-3 mt-2">
			<button class="btn p-0 border-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="fa-solid fa-bars text-primary"></i>
			</button>
				<div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
							<li><?= $this->Html->link(__('Edit Question'), ['action' => 'edit', $question->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Form->postLink(__('Delete Question'), ['action' => 'delete', $question->id], ['confirm' => __('Are you sure you want to delete # {0}?', $question->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><hr class="dropdown-divider"></li>
				<li><?= $this->Html->link(__('List Questions'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Html->link(__('New Question'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
							</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="row">
	<div class="col-md-9">
		<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
			<div class="card-body text-body-secondary">
            <h3><?= h($question->section) ?></h3>
    <div class="table-responsive">
        <table class="table">
                <tr>
                    <th><?= __('Section') ?></th>
                    <td><?= h($question->section) ?></td>
                </tr>
                <tr>
                    <th><?= __('Question Code') ?></th>
                    <td><?= h($question->question_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Response Type') ?></th>
                    <td><?= h($question->response_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($question->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Max Score') ?></th>
                    <td><?= $this->Number->format($question->max_score) ?></td>
                </tr>
                <tr>
                    <th><?= __('Is Crisis Trigger') ?></th>
                    <td><?= $question->is_crisis_trigger === null ? '' : $this->Number->format($question->is_crisis_trigger) ?></td>
                </tr>
                <tr>
                    <th><?= __('Order Num') ?></th>
                    <td><?= $this->Number->format($question->order_num) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $question->status === null ? '' : $this->Number->format($question->status) ?></td>
                </tr>
            </table>
            </div>
            <div class="text">
                <strong><?= __('Question Text') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($question->question_text)); ?>
                </blockquote>
            </div>

			</div>
		</div>
		

            
            

            <div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
            <div class="card-body text-body-secondary">
                <h4><?= __('Related Responses') ?></h4>
                <?php if (!empty($question->responses)) : ?>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Assessment Id') ?></th>
                            <th><?= __('Response Value') ?></th>
                            <th><?= __('Response Text') ?></th>
                            <th><?= __('Status') ?></th>
                            <th><?= __('Created At') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($question->responses as $responses) : ?>
                        <tr>
                            <td><?= h($responses->id) ?></td>
                            <td><?= h($responses->assessment_id) ?></td>
                            <td><?= h($responses->response_value) ?></td>
                            <td><?= h($responses->response_text) ?></td>
                            <td><?= h($responses->status) ?></td>
                            <td><?= h($responses->created_at) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Responses', 'action' => 'view', $responses->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Responses', 'action' => 'edit', $responses->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Responses', 'action' => 'delete', $responses->id], ['confirm' => __('Are you sure you want to delete # {0}?', $responses->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>

		
	</div>
	<div class="col-md-3">
	  Column
	</div>
</div>




