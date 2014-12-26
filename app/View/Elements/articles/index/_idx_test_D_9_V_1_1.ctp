<br>
<br>

<?php 

	/**********************************
	* setup
	**********************************/
	$keys = array_keys($a_categorized);
	
// 	ksort($a_categorized);
	
?>

<?php 
	
	$vars = array('keys' => $keys);

	//REF http://weble.org/2012/05/03/cakephp-variable-element
	echo $this->element('articles/index/_idx_test_D_9_V_1_1_Header', $vars); 
?>

<?php 

	foreach ($keys as $k) {
	
		$a_group = $a_categorized[$k];

		// validate: any articles?
		if (count($a_group) < 1) {
			
			continue;
			
		}
		
		$category_name = $this->Article->get_CategoryName_From_CategoryID($k);
		
// 		echo $category_name['Category']['name'];
// 		debug($category_name);
		
		echo "<a name=\"$category_name\">$category_name($k)</a>";
// 		echo "<a name=\"$k\">$k</a>";

		echo " (".count($a_group).")";
		
		echo " | ";
		
		echo "<a href=\"#top\">Top</a>";
		
		echo " ";
		
		echo "<a href=\"#bottom\">Bottom</a>";
		
		echo "<br>";
		
?>

<table>

	<?php 
	
		$counter = 1;
		
		foreach ($a_group as $a) {
	?>

	<tr>
	
		<td 
			<?php 
				if($counter % 2 == 0) {
					
					echo "class=\"td_id\"";
				
				} else {
	
					echo "class=\"td_id_color\"";
	
				}
			?>
		>
			<?php echo $counter; ?>
		</td>
	
		<td class="article_line">
			<?php 
				
				$option = array(
						'target'	=> '_blank',
						'escape'	=> false,
// 						'?'	=> "article_url=".$a['url']
// 						'article_url'	=> $a['url']
				);
				
				$param = array(
					
						'article_url'	=> $a['url'],
						'article_line'	=> $a['line'],
						'article_vendor'	=> $a['vendor'],
				);
			
				echo $this->Html->link(
								$a['line'],
								array(
									'action'	=> 'open_article',
									//REF http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html "'?' => array('height' => 400, 'width' => 500))"
									'?'			=> $param
// 									'?'	=> "article_url=".$a['url']
// 									'article_url'	=> $a['url']
								),
// 								$a['url'],
								$option
					);
			?>
			<?php //echo $a['line']; ?>
		</td>
	
		<td class="td_news_time">
			<?php echo $a['vendor']; ?>
		</td>
	
		<td class="td_news_time">
			<?php echo $a['news_time']; ?>
		</td>
	
	</tr>
	
	<?php
	
			$counter += 1;
	
		}//foreach ($a_group as $a)
	
	?>

</table>


<?php

	}//foreach ($keys as $k)
	
?>
