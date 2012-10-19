<div class="Users index">
	<h2><?php echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('password'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('group_id'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('updated'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
	foreach ($Users as $User): ?>
	<tr>
		<td><?php echo h($User['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($User['User']['username']); ?>&nbsp;</td>
		<td><?php echo h($User['User']['password']); ?>&nbsp;</td>
		<td><?php echo h($User['User']['email']); ?>&nbsp;</td>
		<td><?php echo h($User['Group']['alias']); ?>&nbsp;</td>
		<td><?php echo h($User['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($User['User']['updated']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $User['User']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $User['User']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $User['User']['id']), null, __('Are you sure you want to delete # %s?', $User['User']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'aros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Controllers'), array('controller' => 'acos', 'action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List ACL'), array('controller' => 'aros_acos', 'action' => 'index')); ?></li>
	</ul>
</div>
