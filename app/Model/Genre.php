<?php

class Genre extends AppModel {

	var $name = 'Genre';

	var $hasMany = array(
				
			'Category' => array(
						
					'className' => 'Category'
			)
				
	);
	
}