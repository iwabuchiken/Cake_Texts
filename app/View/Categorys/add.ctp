<h1>Add Category</h1>
<?php

	$opt_input = array(
			
			'onmouseover' => 'this.select()',
			'rows' => '1',
				
			'class'	=> 'add_name'
			
	);

	$opt_input_genre_id = array(
			'type'		=> 'select',
			'options'	=> $select_Genres,
			//REF http://satussy.blogspot.jp/2011/07/cakephp-select.html "見つけた方法は"
// 			'selected'	=> $genre_id,
				
			'onmouseover' => 'this.select()',
			
// 			'label'		=> false,
// 			'name'		=> "genre_id",
			'div'		=> false
			// 					'inputDefaults' => array(
					// 											'label' => false,
					// 											'div' => false
					// 									)
	);

	echo $this->Form->create('Category');
	
	echo $this->Form->input('name', $opt_input);
	echo $this->Form->input('genre_id', $opt_input_genre_id);
	
// 	echo $this->Form->input('body', array('rows' => '3'));
	echo $this->Form->end('Save Category');
?>