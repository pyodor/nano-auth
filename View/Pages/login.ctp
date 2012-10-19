<div class="Users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('User Login'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
<div id='forgot_password'>
    <?php echo $this->Html->link('Forgot Password', '/forgot_password'); ?>
</div>
</div>
