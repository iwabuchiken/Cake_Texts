<?php 

	$option = array(
						'target'	=> '_blank',
						'escape'	=> false,
// 						'?'	=> "article_url=".$a['url']
// 						'article_url'	=> $a['url']
				);

?>

<?php foreach ($historys as $history): ?>
<tr>
		<td><?php echo $history['History']['id']; ?></td>
		<td>
			<?php 
			
				$line = $history['History']['line'];
				
				$line = $this->History->sanitize($line);
			
// 				echo $this->Html->link($history['History']['line'],
				echo $this->Html->link($line,
// 				echo $this->Html->link(Sanitize::html($line, array('remove' => true)),
// 				echo $this->Html->link(Sanitize::html($line, remove),	// Unsupported operand types
// 				echo $this->Html->link(Sanitize::html($line, true),		// Unsupported operand types
// 				echo $this->Html->link(htmlentities($history['History']['line']),
							array(
								'controller' => 'historys', 
								'action' => 'view', 
								$history['History']['id']),
							$option
							); ?>
		</td>
		
		<td><?php echo $history['History']['vendor']; ?></td>
		
		<td><?php echo $history['History']['news_time']; ?></td>
		
		<td>
			<?php 
			
				$category_id = $history['Category']['id'];
			
				if ($category_id == null) {
// 				if ($category_id == CONS::$category_Others_Num) {

// 					$label = "null";
					$label = CONS::$category_Others_Label;
					
				} else if ($category_id == "") {
// 				if ($category_id == CONS::$category_Others_Num) {

					$label = "\"\"";
					
				} else {
					
					$label = $history['Category']['name'];
					
				}
				
// 				debug($label);
				
// 				echo $category_id; 
				echo $label; 
// 				echo $history['Category']['id']; 
					
			?>
		</td>
		
		<td>
		
			<?php 
			
				if ($category_id != null) {

					$genre = $this->History->get_Genre_From_HistoryID(
							$history['History']['id']);

					$label = $genre['Genre']['name'];
					
				} else {
					
					$label = "No genre";

				}
				
				echo $label;
// 				echo $genre['Genre']['name'];
				
// 				echo $history['Category']['name']; 
				
			?>
			
		</td>
		
		<td><?php echo $history['History']['created_at']; ?></td>
		<td><?php echo $history['History']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($history); ?>
