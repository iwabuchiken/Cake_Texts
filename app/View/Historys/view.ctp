<h1>

	<?php 
	
		echo $history['History']['line']; 
// 		echo h($history['History']['line']); 
		
	?>
	
</h1>

<br>
word => <?php echo $word; ?>
<br>
<br>

<table class="table_show">
  <tr>
    <td class="td_label_narrow">ID</td>
    <td class="td_value_mideum"><?php echo $history['History']['id']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Line</td>
    
    <td class="td_value_mideum">
    
    	<?php 
    	
//     		echo $history['History']['line']; 
    		$line = $this->History->sanitize($history['History']['line']);
    		
    		$option = array(
						'target'	=> '_blank',
// 						'escape'	=> false,
// 						'?'	=> "article_url=".$a['url']
// 						'article_url'	=> $a['url']
				);
    		
	    	echo $this->Html->link($line,
	    			$history['History']['url'],
					$option
	    								);
    		
    	?>
    	
    </td>
    
  </tr>
  
  <tr>
    <td class="td_label_narrow">
    
    		Content
    		
    		<br>
    		<br>
    		
    		<span 
    			class="button" 
    			onclick="modify_content(<?php echo $history['History']['id']?>)">
    			
    					Modify
    					
    		</span>
    		
    		<?php 
    		
    		
// 				echo $this->Html->link(
// 							'Modify',
// 							array(
// 									'type' => 'button'
// 							),
// 							array(
// 									// 							'style'	=> 'color: blue'
// 									'class'		=> 'button'
// 							)
// 						);    			
    		?>
    </td>
    
    <td class="td_value_mideum" id="history_content">
    
    
    	<?php 
    	
    		echo $this->element(	
					"historys/content_multilines", 
					array("content_html", $content_html));

//     		echo $history['History']['content']; 
    		
    	?>
    	
    </td>
    
  </tr>
  
  <tr>
    <td class="td_label_narrow">Vendor</td>
    <td class="td_value_mideum"><?php echo $history['History']['vendor']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Time</td>
    <td class="td_value_mideum"><?php echo $history['History']['news_time']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Category</td>
    <td class="td_value_mideum">
    
    	<?php 
    	
//     		echo $history['Category']['name'];
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
  </tr>
  
  <tr>
    <td class="td_label_narrow">Genre</td>
    <td class="td_value_mideum">
    
    	<?php 

	    	if ($category_id != null) {
	    	
	    		$genre = $this->History->get_Genre_From_HistoryID(
	    				$history['History']['id']);
	    	
	    		$label = $genre['Genre']['name'];
	    			
	    	} else {
	    			
	    		$label = "No genre";
	    	
	    	}
	    	
	    	echo $label;
	    	 
    	
// 	    	$genre = $this->History->get_Genre_From_HistoryID(
// 	    			$history['History']['id']);
	    	
// 	    	echo $genre['Genre']['name'];
	    	
//     		echo $history['Category']['name'];
    		
    	?>
    	
    </td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Created at</td>
    <td class="td_value_mideum"><?php echo $history['History']['created_at']; ?></td>
  </tr>
  
</table>

<!-- <p> -->
<table id="history_view">
	<tr>
	
		<td class="history_ops">

			<?php echo $this->Html->link(
							'Delete History',
							array(
									'controller' => 'historys', 
									'action' => 'delete', 
									$history['History']['id']
							),
							array(
									// 							'style'	=> 'color: blue'
									'class'		=> 'button'
							),
								
							//REF http://stackoverflow.com/questions/22519966/cakephp-delete-confirmation answered Mar 19 at 23:18
							__("Delete? => %s", $history['History']['line'])
			
						);
			?>
		
		</td>
		
		<td class="history_ops">

			<?php echo $this->Html->link(
							'Save tokens',
							array(
									'controller' => 'historys', 
									'action' => 'save_Tokens', 
									$history['History']['id']
							),

							array(
									'class'		=> 'button'
							)
						);
			?>
		
		</td>
		
	</tr>
	  
</table>
	
<!-- </p> -->
