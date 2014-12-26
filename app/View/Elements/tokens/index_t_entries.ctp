<?php foreach ($tokens as $token): ?>
<tr>
		<td><?php echo $token['Token']['id']; ?></td>
		
		<td><?php echo $token['Token']['form']; ?></td>
		
		<td><?php echo $token['Token']['hin']; ?></td>
		<td><?php echo $token['Token']['hin_1']; ?></td>
		<td><?php echo $token['Token']['hin_2']; ?></td>
		<td><?php echo $token['Token']['hin_3']; ?></td>
		
		<td><?php echo $token['Token']['katsu_kei']; ?></td>
		<td><?php echo $token['Token']['katsu_kata']; ?></td>
		
		<td><?php echo $token['Token']['genkei']; ?></td>
		<td><?php echo $token['Token']['yomi']; ?></td>
		<td><?php echo $token['Token']['hatsu']; ?></td>
		
		<td>
		
			<?php 
// 				echo $token['History']['id']; 
				
				echo $this->Html->link($token['History']['id'],
						array(
							'controller' => 'historys',
							'action' => 'view',
							$token['History']['id'])
										);
						
			?>
			
		</td>
		
		<td><?php echo $token['Token']['created_at']; ?></td>
		<td><?php echo $token['Token']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($token); ?>
