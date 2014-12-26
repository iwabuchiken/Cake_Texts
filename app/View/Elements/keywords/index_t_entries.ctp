<?php foreach ($keywords as $keyword): ?>
<tr>
		<td class="td_id">
		
			<?php 
				echo $keyword['Keyword']['id']; 
			?>
			
		</td>
		
		<td>
			<?php echo $this->Html->link($keyword['Keyword']['name'],
							array(
								'controller' => 'keywords', 
								'action' => 'view', 
								$keyword['Keyword']['id'])
							); ?>
		</td>
		
		<td class="td_news_time"><?php echo $keyword['Category']['name']; ?></td>
		
		<td class="td_news_time">
		
			<?php 
			
				$genre = $this->Keyword->get_Genre_From_KeywordID(
											$keyword['Keyword']['id']);

				echo $genre['Genre']['name']; 
				
			?>
			
		</td>
		
		<td class="td_news_time"><?php echo $keyword['Keyword']['created_at']; ?></td>
		<td class="td_news_time"><?php echo $keyword['Keyword']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($keyword); ?>
