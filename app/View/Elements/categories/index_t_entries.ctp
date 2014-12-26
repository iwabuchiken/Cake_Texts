<?php foreach ($categories as $category): ?>
<tr>
		<td class="td_id"><?php echo $category['Category']['id']; ?></td>
		<td>
			<?php echo $this->Html->link($category['Category']['name'],
							array(
								'controller' => 'categorys', 
								'action' => 'view', 
								$category['Category']['id'])
							); ?>
		</td>
		
		<td class="td_news_time"><?php echo $category['Genre']['name']; ?></td>
		
		<td class="td_news_time"><?php echo $category['Category']['original_id']; ?></td>
		
		<td class="td_news_time"><?php echo $category['Category']['created_at']; ?></td>
		<td class="td_news_time"><?php echo $category['Category']['updated_at']; ?></td>
		
</tr>
<?php endforeach; ?>
<?php unset($category); ?>
