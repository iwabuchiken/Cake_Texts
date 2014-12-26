
<div>
<!-- <div id="a_list_header"> -->

<!-- 	Header<br> -->
	
	<?php 

// 		sort($keys);
// 		asort($keys);
	
		if (count($keys) < 2) {
			
			echo $keys[0];
			
		} else {
			
			$i = 0;
			
// 			$col_num = count($a_categorized) / 4;
			$col_num = count($a_categorized) / 3;
// 			$col_num = count($a_categorized) / 2;
// 			$col_num = 7;
			
			echo "<table id=\"a_list_header\">";
// 			echo "<table>";
			
			for (; $i < count($keys) - 1; $i++) {

				if ($i % $col_num == 0) {
					echo "<tr>";
					
					echo "<td class=\"plain\">";
						
				} else {

					echo "<td class=\"plain\">";
					
				}
				
// 				echo $keys[$i];
				$category_name = 
						$this->Article->get_CategoryName_From_CategoryID($keys[$i]);
				
				if (count($a_categorized[$keys[$i]]) == 0) {
				
					echo "<a href=\"#".$category_name."\" class=\"no_article\">";
// 					echo "<a href=\"#".$keys[$i]."\" class=\"no_article\">";
				
				} else {
				
					echo "<a href=\"#".$category_name."\" class=\"has_link\">";
				
				}
				
				echo $category_name."</a>";
// 				echo $keys[$i]."</a>";

				echo "(".count($a_categorized[$keys[$i]]).")";
			
// 				echo " | ";
				
// 				if (($i != 0) && $col_num % $i == 0) {
				if ($i % $col_num == $col_num - 1) {
					
					echo "</td></tr>";
					
				} else {
					
					echo "</td>";
					
				}
				
			}
			
			// "Others"
			if (count($a_categorized) % $col_num == 1) {
				
				echo "<tr>";

				echo "<td class=\"plain\">";
				
			} else {

				echo "<td class=\"plain\">";
				
			}
			
			$category_name =
					$this->Article->get_CategoryName_From_CategoryID($keys[$i]);
			
// 			echo $keys[$i];
			echo "<a href=\"#".$category_name."\">".$category_name."</a>";
// 			echo "<a href=\"#".$keys[$i]."\">".$keys[$i]."</a>";
			
			echo "(".count($a_categorized[$keys[$i]]).")";
			
// 			if (count($a_categorized) % $col_num == 0) {
			
// 				echo "</td></tr>";
			
// 			} else {
				
// 				echo "<td>";
				
// 			}
			echo "</td></tr>";
			
			echo "</table>";
			
		}//if (count($keys) < 2)
	
	?>
	
</div>

<?php 


// 	$keys = array_keys($a_categorized);
	
?>


