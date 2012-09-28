<?php if(isset($user) && $user) { ?> 
<div class="naUsers form">
<?php echo $this->Form->create(array('controller'=>'NaUsers', 'action'=>'password_reset')); ?>
	<fieldset>
		<legend><?php echo __('Reset your password'); ?></legend>
	<?php
		echo $this->Form->input('password', array('label'=>'New Password'));
        echo $this->Form->input('password_confirmation', array('label'=>'Confirm Password', 'type'=>'password'));
        echo $this->Form->input('code', array('type'=>'hidden', 'value'=>$user['NaUser']['password_reset_code']));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php } ?>
