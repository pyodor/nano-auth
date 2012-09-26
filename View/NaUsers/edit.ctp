<div class="naUsers form">
<?php echo $this->Form->create('NaUser'); ?>
	<fieldset>
		<legend><?php echo __('Edit Na User'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('username');
		echo $this->Form->input('password_crypt');
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('NaUser.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('NaUser.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Na Users'), array('action' => 'index')); ?></li>
	</ul>
</div>
