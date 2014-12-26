<?php 
	
	$opt_input_category = array(
	
	// 			'onmouseover' => 'this.select()',
	// 			'rows' => '3',
				
			'type'		=> 'select',
			'options'	=> $select_Categories,
				
			'id'		=> "category",
			'label'		=> ''
			
	);


	echo $this->Form->input('category_id', $opt_input_category);

?>