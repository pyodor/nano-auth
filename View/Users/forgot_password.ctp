<div class="Users form">
<?php echo $this->Form->create(array('controller'=>'Users', 'action'=>'forgot_password')); ?>
	<fieldset>
		<legend><?php echo __('Forgot Password'); ?></legend>
	<?php
		echo $this->Form->input('email');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
