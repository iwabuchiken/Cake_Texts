<h1>

	Tokens (<a href="#bottom">Bottom</a><a name="top"></a>)
	
		(total = <?php echo $num_of_tokens; ?>, pages = <?php echo $num_of_pages; ?>)
	
</h1>

<?php echo $this->element('tokens/_index_pagination')?>

<table>

	<?php echo $this->element('tokens/index_t_headers'); ?>

		<!-- Here is where we loop through our $tokens array, printing out post info -->

	<?php echo $this->element('tokens/index_t_entries'); ?>
		
</table>

<?php echo $this->Html->link("Add token",
							array(
								'controller' => 'tokens', 
								'action' => 'add')
							); 
?>


(<a href="#top">Top</a><a name="bottom"></a>)


<br>
<br>

<?php 

	echo $this->Html->link(
				    'Delete all',
				    array('controller' => 'tokens', 'action' => 'delete_all'),
					null,
					__("Delete all tokens?")
	); 

?>


<?php 

// 	echo $this->Html->link(
// 				    'Add Token',
// 				    array('controller' => 'tokens', 'action' => 'add')
// 	); 

?>
