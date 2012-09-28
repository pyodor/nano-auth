<div class="naUsers view">
<h2><?php  echo __('Na User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($naUser['NaUser']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($naUser['NaUser']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($naUser['NaUser']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($naUser['NaUser']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($naUser['NaUser']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($naUser['NaUser']['updated']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Na User'), array('action' => 'edit', $naUser['NaUser']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Na User'), array('action' => 'delete', $naUser['NaUser']['id']), null, __('Are you sure you want to delete # %s?', $naUser['NaUser']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Na Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Na User'), array('action' => 'add')); ?> </li>
	</ul>
</div>
