<br>
<br>
test D-9
<br>
<br>

<?php 

	$keys = array_keys($a_categorized);
	
	echo "keys => ".count($keys);

	echo "<br><br>";
	
	foreach ($keys as $k) {

		echo "$k => ".count($a_categorized[$k]);
		
		echo "<br><br>";
	
	}
	
	

?>



<?php echo $keys[0]; ?>

<table>


	<?php 
		
		$a_group = $a_categorized[$keys[0]];
	
		$counter = 1;
		
		foreach ($a_group as $a) { 

	?>
		<tr>
				<td>
				
					<?php echo $counter ?>
				
				</td>
				
				<td>
				
					<?php echo $a['line']; ?>
				
				</td>
				
				<td>
				
					<?php echo $a['vendor']; ?>
				
				</td>
				
				<td>
				
					<?php echo $a['news_time']; ?>
				
				</td>
			
		</tr>	
		
	<?php 
	
			$counter += 1;
	
		} 
		
	?>

</table>