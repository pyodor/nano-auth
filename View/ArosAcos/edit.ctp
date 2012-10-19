<div class="arosAcos form">
<?php echo $this->Form->create('ArosAco'); ?>
	<fieldset>
		<legend><?php echo __('Edit ACL'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('Aro.alias', array('label'=>'Group', 'disabled'=>true));
		echo $this->Form->input('Aco.alias', array('label'=>'Controller', 'disabled'=>true));
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ArosAco.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('ArosAco.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List ACL'), array('action' => 'index')); ?></li>
	</ul>
</div>
