<div class="acos form">
<?php echo $this->Form->create('Aco'); ?>
	<fieldset>
		<legend><?php echo __('Add Controller'); ?></legend>
	<?php
		echo $this->Form->input('alias');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Controllers'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'aros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'aros', 'action' => 'add')); ?> </li>
	</ul>
</div>
