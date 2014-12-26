<?php foreach ($eqs as $eq): ?>
<tr>
		<td><?php echo $eq['Eq']['id']; ?></td>
		
		<td>
			<?php 
// 				echo $eq['Eq']['epi'];
				echo $this->Html->link($eq['Eq']['epi'],
										array(
													'controller' => 'eqs',
													'action' => 'view',
													$eq['Eq']['id'])
										);
				
			?>
		</td>
		
		<td>
		
			<?php 
			
				echo $eq['Eq']['time_eq'];

				echo "(".$eq['Eq']['time_eq_serial'].")";
				
			?>
			
		</td>
		
		<td><?php echo $eq['Eq']['mag']; ?></td>
		
		<td><?php echo $eq['Eq']['ss']; ?></td>
		
		<td>
			<?php 
			
				$option = array(
						'target'	=> '_blank',
						'escape'	=> false,
				);
					
				echo $this->Html->link(
								"image",
								$eq['Eq']['url_img'],
								$option
								); 
			?>
		</td>
		
		
		<td><?php echo $eq['Eq']['created_at']; ?></td>
		
<!-- 		<td> -->
			<?php //echo $eq['Eq']['updated_at']; ?>
<!-- 		</td> -->
		
</tr>
<?php endforeach; ?>
<?php unset($eq); ?>
