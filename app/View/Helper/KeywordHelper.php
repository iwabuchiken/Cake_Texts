<?php
//REF http://www.programmersvilla.com/forums/topic/how-to-create-custom-helper-in-cakephp/

class KeywordHelper extends AppHelper{
	
	public function 
	get_Genre_From_KeywordID
	($keyword_id){

		/**********************************
		* keyword
		**********************************/
		//REF http://stackoverflow.com/questions/13356205/how-do-i-use-model-in-helper-cakephp-2-x answered Nov 13 '12 at 6:13
		App::import("Keyword");
		$model = new Keyword();
		
		$option = array(
				'conditions' => array('Keyword.id' => $keyword_id));
		
		$keyword = $model->find('first', $option);
// 		$keyword = $this->Keyword->find('first', $option);

		/**********************************
		* category
		**********************************/
		App::import("Category");
		$model = new Category();
		
		$option = array(
				'conditions' => array('Category.id' => $keyword['Category']['id']));
		
		$category = $model->find('first', $option);
		
		/**********************************
		* genre
		**********************************/
		App::import("Genre");
		$model = new Genre();
		
		$option = array(
				'conditions' => array('Genre.id' => $category['Genre']['id']));
		
		$genre = $model->find('first', $option);
		
		return $genre;
		
	}//get_Genre_From_KeywordID
	
	public function testFunction($arg1){
		
		$path_Utils = join(DS, array(ROOT, APP_DIR, "Lib", "utils"));
		
		require_once $path_Utils.DS."utils.php";
		
		return Utils::conv_Float_to_TimeLabel($arg1);
		
// 		return ".$arg1.";
	}
	
	public function 
	build_Path_ContAction($cont, $action) {
		
		return array('controller' => $cont, 
				    	'action' => $action);
		
	}
	
	public function 
	build_Path_ContActionParam($cont, $action, $param) {
		
		$arry = array();
		
		$arry['controller'] = $cont;
		$arry['action'] = $action;
		$arry['?'] = $param;
		
		return $arry;
		
	}
	
}