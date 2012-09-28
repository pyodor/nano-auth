<div class="naUsers form">
<?php echo $this->Form->create(array('controller'=>'NaUsers', 'action'=>'forgot_password')); ?>
	<fieldset>
		<legend><?php echo __('Forgot Password'); ?></legend>
	<?php
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
