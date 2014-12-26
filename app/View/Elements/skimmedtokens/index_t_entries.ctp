<?php foreach ($skimmedtokens as $token): ?>
<tr>
		<td><?php echo $token['SkimmedToken']['id']; ?></td>
		
		<td><?php echo $token['SkimmedToken']['form']; ?></td>
		
		<td><?php echo $token['SkimmedToken']['hin']; ?></td>
		<td><?php echo $token['SkimmedToken']['hin_1']; ?></td>
		<td><?php echo $token['SkimmedToken']['hin_2']; ?></td>
		<td><?php echo $token['SkimmedToken']['hin_3']; ?></td>
		
		<td><?php echo $token['SkimmedToken']['katsu_kei']; ?></td>
		<td><?php echo $token['SkimmedToken']['katsu_kata']; ?></td>
		
		<td><?php echo $token['SkimmedToken']['genkei']; ?></td>
		<td><?php echo $token['SkimmedToken']['yomi']; ?></td>
		<td><?php echo $token['SkimmedToken']['hatsu']; ?></td>
		
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
		
		<td><?php echo $token['SkimmedToken']['created_at']; ?></td>
		<td><?php echo $token['SkimmedToken']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($token); ?>
