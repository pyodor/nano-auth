<div class="naUsers form">
<?php echo $this->Form->create('NaUser'); ?>
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
