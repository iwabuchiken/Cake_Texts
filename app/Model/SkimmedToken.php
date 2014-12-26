<?php

class SkimmedToken extends AppModel {

	var $name = 'SkimmedToken';
	
	var $belongsTo = 'History';

	var $validate = array(
			'form' => array(
					//REF http://www.kayakinglifestyle.jp/cakephp%E3%81%AEisunique%E3%83%A1%E3%82%BD%E3%83%83%E3%83%89%E3%81%A7%E8%A4%87%E6%95%B0%E3%83%95%E3%82%A3%E3%83%BC%E3%83%AB%E3%83%89%E3%81%A7%E3%81%AE%E4%B8%80%E6%84%8F%E6%80%A7/516
						'unique' => array(
					                'rule'=>array(
					                		'checkUnique', 
					                		array('form', 'hin')), //ユニークチェックしたいフィールド
					                'message' => 'form and hin => not unique'
            )
				)
// 			'unique_first_last' => array(
// 					'rule'    => array(
// 									'checkMultiColumnUnique', 
// 									array('form', 'hin'), 
// 									false),
					
// 					'message' => 'form and hin must be unique.'
// 			)
// 			'form' => array(
// 					'rule' => 'isUnique',
// 					'message' => 'the form already taken'
// 			)
	);

	//REF http://stackoverflow.com/questions/22643552/cakephp-multi-column-unique-date-id-validation
	public function checkMultiColumnUnique($ignoredData, $fields, $or = true) {
		return $this->isUnique($fields, $or);
	}

	//REF http://www.kayakinglifestyle.jp/cakephp%E3%81%AEisunique%E3%83%A1%E3%82%BD%E3%83%83%E3%83%89%E3%81%A7%E8%A4%87%E6%95%B0%E3%83%95%E3%82%A3%E3%83%BC%E3%83%AB%E3%83%89%E3%81%A7%E3%81%AE%E4%B8%80%E6%84%8F%E6%80%A7/516
	//REF http://stackoverflow.com/questions/2461267/cakephp-isunique-for-2-fields 
	function checkUnique($data, $fields) {
		if (!is_array($fields)) {
			$fields = array($fields);
		}
		foreach($fields as $key) {
			$tmp[$key] = $this->data[$this->name][$key];
		}
		return $this->isUnique($tmp, false);
	}
}