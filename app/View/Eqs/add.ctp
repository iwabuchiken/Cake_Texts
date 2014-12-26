<h1>Add Genre</h1>
<?php
	
	$opt_input = array(
				
			'onmouseover' => 'this.select()',
			'rows' => '3',
			//REF http://stackoverflow.com/questions/10321538/how-to-set-width-and-height-of-text-field-in-cakephp asked Apr 25 '12 at 18:23
			'style' => 'width: 25%'
// 			'style' => 'width: 200px'	// working
// 			'columns' => '10'
// 			'width' => '100'
// 			'cols' => '10'
			
	);

	echo $this->Form->create('Eq');
	
	echo $this->Form->input('epi', $opt_input);
	echo $this->Form->input('mag', $opt_input);
	
	echo $this->Form->end('Save Eq');
	
?>