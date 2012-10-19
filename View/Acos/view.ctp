<div class="acos view">
<h2><?php  echo __('Controller'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($aco['Aco']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alias'); ?></dt>
		<dd>
			<?php echo h($aco['Aco']['alias']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Controller'), array('action' => 'edit', $aco['Aco']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Controller'), array('action' => 'delete', $aco['Aco']['id']), null, __('Are you sure you want to delete # %s?', $aco['Aco']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Controllers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Controller'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __("Groups ACL'ed"); ?></h3>
	<?php if (!empty($aco['Aro'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Alias'); ?></th>
		<th><?php echo __('Allowed'); ?></th>
		<th><?php echo __('Denied'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($aco['Aro'] as $aro): ?>
		<tr>
			<td><?php echo $aro['id']; ?></td>
            <td><?php echo $aro['alias']; ?></td>
            <td>
            <?php
            if($aro['Permission']['_create']) echo 'create,';
            if($aro['Permission']['_read']) echo 'read,';
            if($aro['Permission']['_update']) echo 'update,';
            if($aro['Permission']['_delete']) echo 'delete,';
            ?>
            </td>
            <td>
            <?php
            if(!$aro['Permission']['_create']) echo 'create,';
            if(!$aro['Permission']['_read']) echo 'read,';
            if(!$aro['Permission']['_update']) echo 'update,';
            if(!$aro['Permission']['_delete']) echo 'delete,';
            ?>
            </td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'aros', 'action' => 'view', $aro['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'aros', 'action' => 'edit', $aro['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'aros', 'action' => 'delete', $aro['id']), null, __('Are you sure you want to delete # %s?', $aro['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
        <ul>
		    <li><?php echo $this->Html->link(__('List Groups'), array('controller' => 'aros', 'action' => 'index')); ?> </li>
			<li><?php echo $this->Html->link(__('New Group'), array('controller' => 'aros', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
