<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Response $response
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
							<li><?= $this->Html->link(__('Edit Response'), ['action' => 'edit', $response->id], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Form->postLink(__('Delete Response'), ['action' => 'delete', $response->id], ['confirm' => __('Are you sure you want to delete # {0}?', $response->id), 'class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><hr class="dropdown-divider"></li>
				<li><?= $this->Html->link(__('List Responses'), ['action' => 'index'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
				<li><?= $this->Html->link(__('New Response'), ['action' => 'add'], ['class' => 'dropdown-item', 'escapeTitle' => false]) ?></li>
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
            <h3><?= h($response->id) ?></h3>
    <div class="table-responsive">
        <table class="table">
                <tr>
                    <th><?= __('Assessment') ?></th>
                    <td><?= $response->hasValue('assessment') ? $this->Html->link($response->assessment->id, ['controller' => 'Assessments', 'action' => 'view', $response->assessment->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Question') ?></th>
                    <td><?= $response->hasValue('question') ? $this->Html->link($response->question->section, ['controller' => 'Questions', 'action' => 'view', $response->question->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Response Text') ?></th>
                    <td><?= h($response->response_text) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($response->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Response Value') ?></th>
                    <td><?= $response->response_value === null ? '' : $this->Number->format($response->response_value) ?></td>
                </tr>
                <tr>
                    <th><?= __('Status') ?></th>
                    <td><?= $response->status === null ? '' : $this->Number->format($response->status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($response->created_at) ?></td>
                </tr>
            </table>
            </div>

			</div>
		</div>
		

            
            


		
	</div>
	<div class="col-md-3">
	  Column
	</div>
</div>




