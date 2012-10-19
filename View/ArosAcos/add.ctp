<div class="arosAcos form">
<?php echo $this->Form->create('ArosAco'); ?>
	<fieldset>
		<legend><?php echo __('Add Aros Aco'); ?></legend>
	<?php
		echo $this->Form->input('aro_id');
		echo $this->Form->input('aco_id');
		echo $this->Form->input('_create');
		echo $this->Form->input('_read');
		echo $this->Form->input('_update');
		echo $this->Form->input('_delete');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Aros Acos'), array('action' => 'index')); ?></li>
	</ul>
</div>
