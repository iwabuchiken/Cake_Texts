<tr>

	<?php 

		$index = 1;
		
		foreach ($articles as $a) { 
			
	?>
	
	<td 
		<?php 
			if($index % 2 == 0) {
				
				echo "class=\"td_id\"";
			
			} else {

				echo "class=\"td_id_color\"";

			}
		?>
		
	>
		<?php echo $index; ?>
	</td>
	
	<td class="article_line">
		<?php 
			echo $this->Html->link(
					//     					'news',
					//REF http://so-zou.jp/web-app/tech/programming/php/library/simplehtmldom/#no7
					$a['line'],
					$a['url'],
					array('target' => '_blank')
					//     					array('url' => $ahrefs_hl[0]->href)
			);
		?>
	</td>
			
	<td class="td_vendor">
		<?php 	
		
			echo $a['vendor'];
			
		?>
	</td>
		
	<td class="td_news_time">
		<?php 	
		echo $a['news_time'];
		// 				echo $a['vendor'];	// Cannot use object of type simple_html_dom_node as array
		?>
		
	</td>
			
</tr>
	<?php 
	
			$index += 1;
	
		}
	?>
