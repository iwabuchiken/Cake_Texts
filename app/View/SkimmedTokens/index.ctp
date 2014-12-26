<h1>Skimmed tokens (<a href="#bottom">Bottom</a><a name="top"></a>)</h1>
<table>

	<?php echo $this->element('skimmedtokens/index_t_headers'); ?>

		<!-- Here is where we loop through our $genres array, printing out post info -->

	<?php echo $this->element('skimmedtokens/index_t_entries'); ?>
		
</table>

<?php echo $this->Html->link("Add skimmed token",
							array(
								'controller' => 'skimmedtokens', 
								'action' => 'add')
							); 
?>


(<a href="#top">Top</a><a name="bottom"></a>)

<br>
<br>

<?php 

	echo $this->Html->link(
				    'Delete all',
				    array('controller' => 'skimmedtokens', 'action' => 'delete_all'),
					null,
					__("Delete all skimmedtokens?")
	); 

?>


<?php 

// 	echo $this->Html->link(
// 				    'Add Genre',
// 				    array('controller' => 'genres', 'action' => 'add')
// 	); 

?>
