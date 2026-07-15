<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Response $response
 * @var \Cake\Collection\CollectionInterface|string[] $assessments
 * @var \Cake\Collection\CollectionInterface|string[] $questions
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
            <?= $this->Html->link(__('List Responses'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
				</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
    <div class="card-body text-body-secondary">
            <?= $this->Form->create($response) ?>
            <fieldset>
                <legend><?= __('Add Response') ?></legend>
                
                    <?php echo $this->Form->control('assessment_id', ['options' => $assessments]); ?>
                    <?php echo $this->Form->control('question_id', ['options' => $questions]); ?>
                    <?php echo $this->Form->control('response_value'); ?>
                    <?php echo $this->Form->control('response_text'); ?>
                    <?php echo $this->Form->control('status'); ?>
                    <?php echo $this->Form->control('created_at', ['empty' => true]); ?>
               
            </fieldset>
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
                </div>
        <?= $this->Form->end() ?>
    </div>
</div>