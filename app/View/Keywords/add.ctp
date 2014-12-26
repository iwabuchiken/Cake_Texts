<h1>Add Keyword</h1>
<?php

	$opt_input_name = array(
				
// 			'onmouseover' => 'show_msg();',
			'onmouseover' => 'this.select();',
// 			'onmouseover' => 'this.select(); show_msg();',
			'rows' => '1',
			
			'class'	=> 'add_name'
// 			'cols'	=> '10'
// 			'width'	=> '100px'
// 			'columns'	=> '5'
			
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

	echo $this->Form->create('Keyword');
	
	echo $this->Form->input('name', $opt_input_name);
	echo $this->Form->input('genre_id', $opt_input_genre);
	echo $this->Form->input('category_id', $opt_input_category);
	
	echo $this->Form->end('Save Keyword');
?>

<!-- <div id="add_kw_ajax">abc</div> -->