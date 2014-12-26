<h1>

	Histories (<a href="#bottom">Bottom</a><a name="top"></a>)
	
		(total = <?php echo $num_of_histories; ?>, pages = <?php echo $num_of_pages; ?>)
		
</h1>

<?php echo $this->element('historys/_index_pagination')?>

<table>

	<?php echo $this->element('historys/index_t_headers'); ?>

		<!-- Here is where we loop through our $genres array, printing out post info -->

	<?php echo $this->element('historys/index_t_entries'); ?>
		
</table>

<?php echo $this->Html->link("Add history",
							array(
								'controller' => 'historys', 
								'action' => 'add')
							); 
?>


(<a href="#top">Top</a><a name="bottom"></a>)

<?php 

// 	echo $this->Html->link(
// 				    'Add Genre',
// 				    array('controller' => 'genres', 'action' => 'add')
// 	); 

?>
