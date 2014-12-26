<h1>Add SkimmedToken</h1>
<?php
	
	$opt_input = array(
				
			'onmouseover' => 'this.select()',
			'rows' => '3'
			
	);

	echo $this->Form->create('SkimmedToken');
	
	echo $this->Form->input('form', $opt_input);
	echo $this->Form->input('hin', $opt_input);
	echo $this->Form->input('hin_1', $opt_input);
	echo $this->Form->input('hin_2', $opt_input);
	echo $this->Form->input('hin_3', $opt_input);
	
	echo $this->Form->end('Save SkimmedToken');
	
?>