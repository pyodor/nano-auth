<div class="naUsers form">
<?php echo $this->Form->create('NaUser'); ?>
	<fieldset>
		<legend><?php echo __('Add Na User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Na Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
