<h1>Add History</h1>
<?php
	
	$opt_input = array(
				
			'onmouseover' => 'this.select()',
			'rows' => '3'
			
	);

	$opt_input_genre = array(
	
			'type'		=> 'select',
			'options'	=> $select_Genres,
			'onmouseover' => 'this.select()',
				
			'id'		=> "genre",
				
			'selected'	=> $genre_id,
				
			// 			'rows' => '3'
				
				
	);
	
	$opt_input_category = array(
	
	// 			'onmouseover' => 'this.select()',
	// 			'rows' => '3',
				
			'type'		=> 'select',
			'options'	=> $select_Categories,
				
			'id'		=> "category"
		
		
	);
	
	echo $this->Form->create('History');
	
	echo $this->Form->input('line', $opt_input);
	echo $this->Form->input('url', $opt_input);
	echo $this->Form->input('vendor', $opt_input);
	
	echo $this->Form->input('news_time', $opt_input);
	
	echo $this->Form->input('genre_id', $opt_input_genre);
	echo $this->Form->input('category_id', $opt_input_category);
	
	echo $this->Form->input('subcat_id', $opt_input);
	
	echo $this->Form->input('content', $opt_input);
	
	echo $this->Form->end('Save History');
	
?>

