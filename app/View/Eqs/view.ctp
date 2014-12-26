<h1><?php echo h($eq['Eq']['epi']); ?></h1>

<table class="table_show">
  <tr>
    <td class="td_label_narrow">ID</td>
    <td class="td_value_mideum"><?php echo $eq['Eq']['id']; ?></td>
  </tr>
  <tr>
    <td class="td_label_narrow">Epicenter</td>
    <td class="td_value_mideum"><?php echo $eq['Eq']['epi']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Time (EQ)</td>
    <td class="td_value_mideum"><?php echo $eq['Eq']['time_eq']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Maginitude</td>
    <td class="td_value_mideum"><?php echo $eq['Eq']['mag']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Created at</td>
    <td class="td_value_mideum"><?php echo $eq['Eq']['created_at']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Updated at</td>
    <td class="td_value_mideum"><?php echo $eq['Eq']['updated_at']; ?></td>
  </tr>
  
</table>

<p>
	<?php echo $this->Html->link(
					'Delete Eq',
					array(
							'controller' => 'eqs', 
							'action' => 'delete', 
							$eq['Eq']['id']
					),
					array(
							// 							'style'	=> 'color: blue'
// 							'class'		=> 'link_word_alert'
					),
						
					//REF http://stackoverflow.com/questions/22519966/cakephp-delete-confirmation answered Mar 19 at 23:18
					__("Delete? => %s", $eq['Eq']['epi'])
	
				);
	?>

</p>

