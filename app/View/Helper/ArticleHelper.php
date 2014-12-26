<?php
//REF http://www.programmersvilla.com/forums/topic/how-to-create-custom-helper-in-cakephp/

class ArticleHelper extends AppHelper{
	
	public function 
	get_Genre_From_HistoryID
	($history_id){

		/**********************************
		* history
		**********************************/
		//REF http://stackoverflow.com/questions/13356205/how-do-i-use-model-in-helper-cakephp-2-x answered Nov 13 '12 at 6:13
		App::import("History");
		$model = new History();
		
		$option = array(
				'conditions' => array('History.id' => $history_id));
		
		$history = $model->find('first', $option);
// 		$keyword = $this->Keyword->find('first', $option);

		/**********************************
		* category
		**********************************/
		App::import("Category");
		$model = new Category();
		
		$option = array(
				'conditions' => array('Category.id' => $history['Category']['id']));
		
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
	
	public function 
	get_CategoryName_From_CategoryID
	($category_id){

// 		debug($category_id);
		/**********************************
		* "Others"
		**********************************/
		if (((int)$category_id) == CONS::$category_Others_Num) {
			
			return CONS::$category_Others_Label;
			
		}
		
		/**********************************
		* category
		**********************************/
		//REF http://stackoverflow.com/questions/13356205/how-do-i-use-model-in-helper-cakephp-2-x answered Nov 13 '12 at 6:13
		App::import("Category");
		$model = new Category();
		
		$option = array(
				'conditions' => array('Category.id' => (int)$category_id));
// 				'conditions' => array('Category.id' => $category_id));
		
		$category = $model->find('first', $option);

// 		return $category;
		return $category['Category']['name'];
		
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