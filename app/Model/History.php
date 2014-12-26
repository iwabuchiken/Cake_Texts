<?php

//REF http://www.grafikart.fr/forum/topic/4160 on 13/2/12
App::uses('Sanitize', 'Utility');


class History extends AppModel {

	
	var $name = 'History';
	
	var $belongsTo = 'Category';

	var $hasMany = array(
	
			'Token' => array(
	
					'className' => 'Token'
			),
			
			'SkimmedToken' => array(
	
					'className' => 'SkimmedToken'
			)
	
	);
	
	
}