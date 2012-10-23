<div class="arosAcos view">
<h2><?php  echo __('ACL'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($arosAco['ArosAco']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Group'); ?></dt>
		<dd>
			<?php echo h($arosAco['Aro']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Controller'); ?></dt>
		<dd>
			<?php echo h($arosAco['Aco']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __(' Create'); ?></dt>
		<dd>
			<?php echo h($arosAco['ArosAco']['_create']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __(' Read'); ?></dt>
		<dd>
			<?php echo h($arosAco['ArosAco']['_read']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __(' Update'); ?></dt>
		<dd>
			<?php echo h($arosAco['ArosAco']['_update']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __(' Delete'); ?></dt>
		<dd>
			<?php echo h($arosAco['ArosAco']['_delete']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit ACL'), array('action' => 'edit', $arosAco['ArosAco']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete ACLs'), array('action' => 'delete', $arosAco['ArosAco']['id']), null, __('Are you sure you want to delete # %s?', $arosAco['ArosAco']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List ACL'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New ACL'), array('action' => 'add')); ?> </li>
	</ul>
</div>
