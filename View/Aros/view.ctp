<div class="aros view">
<h2><?php  echo __('Group'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($aro['Aro']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alias'); ?></dt>
		<dd>
			<?php echo h($aro['Aro']['alias']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Group'), array('action' => 'edit', $aro['Aro']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Group'), array('action' => 'delete', $aro['Aro']['id']), null, __('Are you sure you want to delete # %s?', $aro['Aro']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Groups'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Group'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __("ACL'ed to these Controllers"); ?></h3>
	<?php if (!empty($aro['Aco'])): ?>
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
		foreach ($aro['Aco'] as $aco): ?>
		<tr>
			<td><?php echo $aco['id']; ?></td>
            <td><?php echo $aco['alias']; ?></td>
            <td>
            <?php
            if($aco['Permission']['_create']) echo 'create,';
            if($aco['Permission']['_read']) echo 'read,';
            if($aco['Permission']['_update']) echo 'update,';
            if($aco['Permission']['_delete']) echo 'delete,';
            ?>
            </td>
            <td>
            <?php
            if(!$aco['Permission']['_create']) echo 'create,';
            if(!$aco['Permission']['_read']) echo 'read,';
            if(!$aco['Permission']['_update']) echo 'update,';
            if(!$aco['Permission']['_delete']) echo 'delete,';
            ?>
            </td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'acos', 'action' => 'view', $aco['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'acos', 'action' => 'edit', $aco['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'acos', 'action' => 'delete', $aco['id']), null, __('Are you sure you want to delete # %s?', $aco['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
        <ul>
		    <li><?php echo $this->Html->link(__('List Controllers'), array('controller' => 'acos', 'action' => 'index')); ?> </li>
		    <li><?php echo $this->Html->link(__('New Controller'), array('controller' => 'acos', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
