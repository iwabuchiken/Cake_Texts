<h1>

	<?php 
	
		echo $a['line']; 
// 		echo h($a['line']); 
		
	?>
	
</h1>

<br>

<table id="open_article">

  <tr>
  
    <td class="td_label_narrow">Line</td>
    
    <td class="open_article_content">
    
    	<?php 
    	
//     		echo $a['line']; 
    		$line = $this->History->sanitize($a['line']);
    		
    		$option = array(
						'target'	=> '_blank',
// 						'escape'	=> false,
// 						'?'	=> "article_url=".$a['url']
// 						'article_url'	=> $a['url']
				);
    		
	    	echo $this->Html->link($line,
	    			$a['url'],
					$option
	    								);
    		
    	?>
    	
    </td>
    
  </tr>
  
  <tr>
    <td class="td_label_narrow">
    
    		Content
    		
    </td>
    
    <td id="open_article_content">
<!--     <td class="open_article_content" id="open_article_content"> -->
    
    	<?php echo $a['content']; ?>
    	
    </td>
    
  </tr>
  
  <tr>
    <td class="td_label_narrow">Vendor</td>
    <td class="open_article_content"><?php echo $a['vendor']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Time</td>
    <td class="open_article_content"><?php echo $a['news_time']; ?></td>
  </tr>
  
  <tr>
    <td class="td_label_narrow">Category</td>
    <td class="open_article_content">
    
    	<?php 
    	
	    	echo $a['category_id'];
    	?>
    	
    </td>
  </tr>
  
  
</table>
