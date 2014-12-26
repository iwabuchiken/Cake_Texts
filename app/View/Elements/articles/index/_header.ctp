<?php 

	$opt_create = array(
					'div' => false,
					//REF http://book.cakephp.org/2.0/en/core-libraries/helpers/form.html#options-for-create 
					'type' => 'get');

	$opt_input = array(
					'type'		=> 'select',
					'options'	=> $select_Genres,
					//REF http://satussy.blogspot.jp/2011/07/cakephp-select.html "見つけた方法は"
					'selected'	=> $genre_id,
			
					'label'		=> false,
					'name'		=> "genre_id",
					'div'		=> false,
			
					'class'		=> 'select_genre'
			);

	$opt_end = array(
			'div' => false,
			
			'class'	=> 'submit_go'
	
	);
	
	echo $this->Form->create('Genre', $opt_create);	
	echo $this->Form->input(
						'', $opt_input
	
					);
	
	//REF http://stackoverflow.com/questions/6360767/form-end-without-a-div-in-cakephp answered Jun 15 '11 at 17:06
	echo $this->Form->submit("Go", $opt_end);

 ?>
