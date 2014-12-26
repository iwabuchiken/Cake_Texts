<h1><?php echo h($category['Category']['name']); ?></h1>

<table class="table_show">
  <tr>
    <td class="td_label_narrow">ID</td>
    <td class="td_value_mideum"><?php echo $category['Category']['id']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">name</td>
    <td class="td_value_mideum"><?php echo $category['Category']['name']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Genre</td>
    <td class="td_value_mideum"><?php echo $category['Genre']['name']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Created at</td>
    <td class="td_value_mideum"><?php echo $category['Category']['created_at']; ?></td>
  </tr>
  
</table>

<p>
	<?php echo $this->Html->link(
					'Delete Category',
					array(
							'controller' => 'categorys', 
							'action' => 'delete', 
							$category['Category']['id']
					),
					array(
							// 							'style'	=> 'color: blue'
// 							'class'		=> 'link_word_alert'
					),
						
					//REF http://stackoverflow.com/questions/22519966/cakephp-delete-confirmation answered Mar 19 at 23:18
					__("Delete? => %s", $category['Category']['name'])
	
				);
	?>

</p>
