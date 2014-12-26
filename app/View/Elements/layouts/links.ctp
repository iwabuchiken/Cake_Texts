<br>
<br>

<table id="links">
	<tr>
	
		<td>
		
			<?php echo $this->Html->link(
								'Articles',
								array('controller' => 'articles', 
										'action' => 'index'),
								array('class' => "button"));
			?>
			
		</td>
		
		<td>
		
			<?php echo $this->Html->link(
								'Genres',
								array('controller' => 'genres', 
										'action' => 'index'),
								array('class' => "button"));
			?>
			
		</td>
	
		<td>
		
			<?php echo $this->Html->link(
								'Categories',
								array('controller' => 'categorys', 
										'action' => 'index'),
								array('class' => "button"));
			?>
			
		</td>
	
		<td>
		
			<?php echo $this->Html->link(
								'Keywords',
								array('controller' => 'keywords', 
										'action' => 'index'),
								array('class' => "button"));
			?>
			
		</td>
	
	</tr>

	<tr>
	
		<td>

			<?php echo $this->Html->link(
					
					'History',
					array('controller' => 'historys', 
							'action' => 'index'),
					array('class' => "button"));
			?>
		
		</td>
		
		<td>

			<?php echo $this->Html->link(
					
					'Token',
					array('controller' => 'tokens', 
							'action' => 'index'),
					array('class' => "button"));
			?>
		
		</td>
		
		<td>

			<?php echo $this->Html->link(
					
					'Skimmed token',
					array('controller' => 'skimmedtokens', 
							'action' => 'index'),
					array('class' => "button"));
			?>
		
		</td>
		
		<td>

			<?php echo $this->Html->link(
					
					'Admin',
					array('controller' => 'admins', 
							'action' => 'index'),
					array('class' => "button"));
			?>
		
		</td>
		
<!-- 		<td> -->

			<?php 
// 				echo $this->Html->link(
					
// 					'Delete Tokens',
// 					array('controller' => 'tokens', 
// 							'action' => 'delete_all'),
// 					array('class' => "button"),
// 					__("Delete all tokens?"));
			?>
		
<!-- 		</td> -->
		
	</tr>

	<tr>
		<td>
		
			<?php echo $this->Html->link(
						
						'EQ',
						array('controller' => 'eqs', 
								'action' => 'index'),
						array('class' => "button"));
				?>
		</td>
	
		<td>
		
			<?php echo $this->Html->link(
						
						'EQ/map',
						array('controller' => 'eqs', 
								'action' => 'map'),
						array('class' => "button"));
				?>
		</td>
	
	</tr>
	
</table>
