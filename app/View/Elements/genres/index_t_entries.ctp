<?php foreach ($genres as $genre): ?>
<tr>
		<td class="td_id"><?php echo $genre['Genre']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($genre['Genre']['name'],
							array(
								'controller' => 'genres', 
								'action' => 'view', 
								$genre['Genre']['id'])
							); ?>
		</td>
		
		<td class="td_news_time"><?php echo $genre['Genre']['code']; ?></td>
		
		<td class="td_news_time"><?php echo $genre['Genre']['created_at']; ?></td>
		<td class="td_news_time"><?php echo $genre['Genre']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($genre); ?>
