		<?php foreach ($positions as $position): ?>
		<tr>
				<td><?php echo $position['Position']['id']; ?></td>
				
				<td><?php echo $position['Video']['title']; ?></td>
				
				<td><?php echo $position['Position']['point']; ?></td>
				
				<td><?php echo $position['Position']['memo']; ?></td>
				
				<td><?php echo $position['Position']['created_at']; ?></td>
				
				<td><?php echo $position['Position']['updated_at']; ?></td>
				
		</tr>
		<?php endforeach; ?>
		<?php unset($position); ?>