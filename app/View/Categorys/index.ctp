<h1>Categories (<a href="#bottom">Bottom</a><a name="top"></a>)</h1>
<table>

	<?php echo $this->element('categories/index_t_headers'); ?>

		<!-- Here is where we loop through our $categories array, printing out post info -->

	<?php echo $this->element('categories/index_t_entries'); ?>
		
</table>

<?php echo $this->Html->link("Add category",
							array(
								'controller' => 'categorys', 
								'action' => 'add')
							); 
?>


(<a href="#top">Top</a><a name="bottom"></a>)

<br>
<br>

<?php 

	echo $this->Html->link(
				    'Delete all',
				    array('controller' => 'categorys', 'action' => 'delete_all'),
					null,
					__("Delete all categories?")
	); 

?>
<br>
<br>
