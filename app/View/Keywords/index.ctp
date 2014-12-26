<h1>

	Keywords (<a href="#bottom">Bottom</a><a name="top"></a>) 
		(total = <?php echo $num_of_kws; ?>, pages = <?php echo $num_of_pages; ?>)
	
</h1>

<?php echo $this->element('keywords/_index_pagination')?>

<table>

	<?php echo $this->element('keywords/index_t_headers'); ?>

		<!-- Here is where we loop through our $keywords array, printing out post info -->

	<?php echo $this->element('keywords/index_t_entries'); ?>
		
</table>

<?php echo $this->Html->link("Add keyword",
							array(
								'controller' => 'keywords', 
								'action' => 'add')
							); 
?>


(<a href="#top">Top</a><a name="bottom"></a>)

<br>
<br>

<?php 

	echo $this->Html->link(
				    'Delete all',
				    array('controller' => 'keywords', 'action' => 'delete_all'),
					null,
					__("Delete all keywords?")
	); 

?>
<br>
<br>


<?php 

// 	echo $this->Html->link(
// 				    'Add Keyword',
// 				    array('controller' => 'keywords', 'action' => 'add')
// 	); 

?>
