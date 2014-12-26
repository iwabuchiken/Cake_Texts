<h1>
	<?php echo $abc;?>
	
	Articles 
		(total = <?php echo count($articles); ?>) 
		(<a href="#bottom">Bottom</a><a name="top"></a>)
	
</h1>

<?php echo $this->element('articles/index/_header'); ?>	


<?php echo $this->element('articles/index/_idx_articles'); ?>	
<?php //echo $this->element('articles/index/_idx_test_D_9'); ?>	


<!-- <table class="articles"> -->

<?php 

// 	echo "<table>";

// 	echo $this->element('articles/index/_idx_t_entries');
	
?>

<!-- </table> -->

(<a href="#top">Top</a><a name="bottom"></a>)

<br>
<?php //phpinfo(); ?>