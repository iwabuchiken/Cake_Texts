<?php

class Category extends AppModel {
	
	var $name = 'Category';
	
	var $belongsTo = 'Genre';
	
	var $hasMany = array(
	
			'Keyword' => array(
	
					'className' => 'Keyword'
			),
	
			'History' => array(
	
					'className' => 'History'
			)
	
	);
	

}