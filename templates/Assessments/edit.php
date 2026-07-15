<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Assessment $assessment
 * @var string[]|\Cake\Collection\CollectionInterface $users
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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $assessment->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $assessment->id), 'class' => 'dropdown-item', 'escapeTitle' => false]
            ) ?>
            <?= $this->Html->link(__('List Assessments'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?>
				</div>
		</div>
    </div>
</div>
<div class="line mb-4"></div>
<!--/Header-->

<div class="card rounded-0 mb-3 bg-body-tertiary border-0 shadow">
    <div class="card-body text-body-secondary">
            <?= $this->Form->create($assessment) ?>
            <fieldset>
                <legend><?= __('Edit Assessment') ?></legend>
                
                    <?php echo $this->Form->control('user_id', ['options' => $users]); ?>
                    <?php echo $this->Form->control('phq9_score'); ?>
                    <?php echo $this->Form->control('gad7_score'); ?>
                    <?php echo $this->Form->control('pss4_score'); ?>
                    <?php echo $this->Form->control('depression_level'); ?>
                    <?php echo $this->Form->control('anxiety_level'); ?>
                    <?php echo $this->Form->control('stress_level'); ?>
                    <?php echo $this->Form->control('overall_risk'); ?>
                    <?php echo $this->Form->control('is_flagged'); ?>
                    <?php echo $this->Form->control('crisis_trigger'); ?>
                    <?php echo $this->Form->control('status'); ?>
                    <?php echo $this->Form->control('submitted_at', ['empty' => true]); ?>
               
            </fieldset>
				<div class="text-end">
				  <?= $this->Form->button('Reset', ['type' => 'reset', 'class' => 'btn btn-outline-warning']); ?>
				  <?= $this->Form->button(__('Submit'),['type' => 'submit', 'class' => 'btn btn-outline-primary']) ?>
                </div>
        <?= $this->Form->end() ?>
    </div>
</div>