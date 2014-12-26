<?php

class KeywordsController extends AppController {
	public $helpers = array('Html', 'Form', 'Keyword');
// 	public $helpers = array('Html', 'Form');

	public $components = array('Paginator');
	
	public function index() {

		/**********************************
		* sort
		**********************************/
		$sort_name = @$this->request->query['sort'];

		if ($sort_name != null && $sort_name != "") {
				
			$opt_order = array($sort_name => 'asc');
				
		} else {
				
			$opt_order = array('id' => 'asc');
				
		}
		
		/**********************************
		* search
		**********************************/
		$search_word = @$this->request->query['search'];
		
		if ($search_word != null && $search_word != "") {
		
			$opt_conditions = array('Keyword.name LIKE' => "%$search_word%");
		
		} else {
		
			$opt_conditions = '';
		
		}
		
		/**********************************
		* paginate
		**********************************/
		$page_limit = 10;
		
		//REF http://www.codeofaninja.com/2013/07/pagination-in-cakephp.html
// 		$this->paginate = array(
// 				'limit' => 10,
// 				'order' => array(
// 						'id' => 'asc'
// 				)
// 		);

// 		if ($sort_name != null && $sort_name != "") {
			
// 			$opt_order = array($sort_name => 'asc');
			
// 		} else {
			
// 			$opt_order = array('id' => 'asc');
			
// 		}
		
		$this->paginate = array(
		// 					'conditions' => array('Image.file_name LIKE' => "%$filter_TableName%"),
// 				'conditions' => array('Image.memos LIKE' => "%$filter_TableName%"),
				'limit' => $page_limit,
				'order' => $opt_order,
				'conditions'	=> $opt_conditions
// 				'order' => array(
// 						'id' => 'asc'
// 				)
		);
		
		$this->set('keywords', $this->paginate('Keyword'));
// 		$this->set('keywords', $this->Keyword->find('all'));
		
		$num_of_kws = count($this->Keyword->find('all'));
		$this->set('num_of_kws', count($this->Keyword->find('all')));
		
		// total pages
// 		$num_of_pages = $num_of_kws / $page_limit;

		//REF ceil http://php.net/manual/ja/function.ceil.php
		$this->set('num_of_pages', (int) ceil($num_of_kws / $page_limit));
// 		$this->set('num_of_pages', (int)($num_of_kws / $page_limit));
		
// 		$this->set('genre', $this->_get_Genre($keyword['Category']['id']));

		//test
// 		$this->render("Keywords/js/add_KW__Genre_Changed");	// not found
// 		$this->render("js/add_KW__Genre_Changed");	// works
		
	}
	
	public function 
	view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid keyword'));
		}
	
		$keyword = $this->Keyword->findById($id);
		if (!$keyword) {
			throw new NotFoundException(__('Invalid keyword'));
		}
		
// 		debug($keyword);
		
		$this->set('keyword', $keyword);
		
		$genre = $this->_get_Genre($keyword['Category']['id']);
		
// 		debug($genre);
		
		$this->set('genre', $this->_get_Genre($keyword['Category']['id']));
		
	}//view

	public function 
	_get_Genre
	($category_id) {
		
		/**********************************
		* category
		**********************************/
		$this->loadModel('Category');
		
		$option = array(
					'conditions' => array('Category.id' => $category_id));
		
		$category = $this->Category->find('first', $option);
// 		$categories = $this->Category->find('all', $option);
		
		/**********************************
		* genre
		**********************************/
		$this->loadModel('Genre');
		
		$option = array(
					'conditions' => array(
									'Genre.id' => $category['Genre']['id']));
// 									'Genre.id' => $categories[0]['Genre']['id']));
		
		$genre = $this->Genre->find('first', $option);
		
		/**********************************
		* return
		**********************************/
		return $genre;
// 		return $genres[0];
		
	}//_get_Genre
	
	public function 
	add() {
		if ($this->request->is('post')) {
			$this->Keyword->create();
			
			$this->request->data['Keyword']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['Keyword']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->Keyword->save($this->request->data)) {
				$this->Session->setFlash(__('Your keywords has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your keywords.'));
		} else {
			
			$select_Genres = $this->_get_Selector_Genre();
			
// 			debug($select_Genres);
			
// 			debug(array_keys($select_Genres));
			
			$this->set('select_Genres', $select_Genres);
			
			if (count($select_Genres) > 1) {
				
				$keys = array_keys($select_Genres);
				
// 				$tmp = $keys[1];
				
				$genre_id = $keys[1];
// 				$genre_id = 0;
// 				$genre_id = array_keys($select_Genres)[1];	// error in remote --> Parse error: syntax error, unexpected '[' 
				
			} else {
				
				$genre_id = 0;
				
			}
			
			
			$select_Categories = 
					$this->_get_Selector_Category_From_GenreID($genre_id);
			
			$this->set('select_Categories', $select_Categories);
			
			$this->set('genre_id', $genre_id);
			
		}
		
	}//add

	public function 
	_get_Selector_Category() {

		$this->loadModel('Category');
		
		$option = array('order' => array('Category.name' => 'asc'));
		
		$genres = $this->Category->find('all', $option);
		
		$select_Categories = array();
		
		foreach ($genres as $genre) {
				
			$genre_Name = $genre['Category']['name'];
			$genre_Id = $genre['Category']['id'];
				
			$select_Categories[$genre_Id] = $genre_Name;
				
		}
		
		return $select_Categories;
		
	}//_get_Selector_Category
	
	public function 
	_get_Selector_Category_From_GenreID($id) {

		$this->loadModel('Category');
		
		if ($id != null) {
			
			$option = array(
					
						'order' => array('Category.name' => 'asc'),
						'conditions'	=> array('Category.genre_id' => $id)
			
			);
			
		} else {
			
			$option = array('order' => array('Category.name' => 'asc'));
			
		}
		
		
		$genres = $this->Category->find('all', $option);
		
		$select_Categories = array();
		
		foreach ($genres as $genre) {
				
			$genre_Name = $genre['Category']['name'];
			$genre_Id = $genre['Category']['id'];
				
			$select_Categories[$genre_Id] = $genre_Name;
				
		}
		
		return $select_Categories;
		
	}//_get_Selector_Category
	
	public function 
	_get_Selector_Genre() {

		$this->loadModel('Genre');
		
		$option = array('order' => array('name' => 'asc'));
		
		$genres = $this->Genre->find('all', $option);
// 		$genres = $this->Genre->find('all');
		
		$select_Genres = array();
		
		foreach ($genres as $genre) {
				
			$genre_Name = $genre['Genre']['name'];
			$genre_Id = $genre['Genre']['id'];
				
			$select_Genres[$genre_Id] = $genre_Name;
				
		}
		
		return $select_Genres;
		
	}//_get_Selector_Genre
	
	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid keyword id'));
		}
	
		$keyword = $this->Keyword->findById($id);
	
		if (!$keyword) {
			throw new NotFoundException(__("Can't find the keyword. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->Keyword->delete($id)) {
			// 		if ($this->Keyword->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"Keyword deleted => %s",
					$keyword['Keyword']['name']));
	
			return $this->redirect(
					array(
							'controller' => 'keywords',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("Keyword can't be deleted => %s",
							$keyword['Keyword']['name']));
	
			// 			$page_num = _get_Page_from_Id($id - 1);
	
			return $this->redirect(
					array(
							'controller' => 'keywords',
							'action' => 'view',
							$id
					));
	
		}
	
	}//public function delete($id)

	public function
	save_Data_Keywords_from_CSV() {
		/**********************************
		* list: categories
		**********************************/
		$this->loadModel('Category');
		
		$categories = $this->Category->find('all');
		
		/**********************************
			* read csv
		**********************************/
		$fname = join(DS, array($this->path_Data, "Keyword_backup.csv"));
		
		// 		$data = $this->csv_to_array($fname, ',');
		$data = Utils::csv_to_array($fname, ',');
	
		/**********************************
			* build list
		**********************************/
		$kw_pairs = $this->_save_Data_Keywords_from_CSV__KWPairs($data);
// 		$cat_pairs = array();
	
// 		for ($i = 3; $i < count($data); $i++) {
				
// 			// 			if ($i < 10) {
	
// 			// 				Utils::write_Log(
// 			// 					Utils::get_dPath_Log(),
// 			// 					//REF http://www.phpbook.jp/func/string/index7.html
// 			// 					sprintf("data[%d] => %s, %s, %s",
// 			// 							$i, $data[$i][0], $data[$i][1], $data[$i][2]),
// 			// 					__FILE__, __LINE__);
	
// 			// 			}
				
// 			$pair = array();
				
// 			array_push($pair, $data[$i][0]);
// 			array_push($pair, $data[$i][1]);
// 			array_push($pair, $data[$i][2]);
// 			array_push($pair, $data[$i][3]);
				
// 			array_push($cat_pairs, $pair);
				
// 		}
	
// 		// 		debug($cat_pairs[0]);
// 		Utils::write_Log(
// 		Utils::get_dPath_Log(),
// 		"\$cat_pairs => ".((string)count($cat_pairs)),
// 		__FILE__, __LINE__);
	
		/**********************************
			* save data
		**********************************/
		$counter = 0;
	
		foreach ($kw_pairs as $kw_pair) {
	
			$this->Keyword->create();

			$cat_id = $this->_save_Data_Keywords_from_CSV__Get_CatID_From_OrigID(
								$kw_pair[3], $categories);
			
			// valiate
			if ($cat_id == false) {
				
				continue;
				
			}
			
			// build param
			$param = array('Keyword' =>
						
					array(
							
							'name'			=> $kw_pair[1],
							'category_id'	=> $cat_id,
							'created_at'	=> Utils::get_CurrentTime(),
							'updated_at'	=> Utils::get_CurrentTime()
							
					)
						
			);
			
			// 			Utils::write_Log(
			// 					Utils::get_dPath_Log(),
			// 					"param => built",
			// 					__FILE__, __LINE__);
				
			if ($this->Keyword->save($param)) {
	
				$counter += 1;
	
			}
				
// 						//test
// 						if ($counter > 20) {
	
// 							break;
	
// 						}
				
		}//foreach ($cat_pairs as $cat_pair)
	
		Utils::write_Log(
		Utils::get_dPath_Log(),
		"counter => ".((string)$counter),
		__FILE__, __LINE__);
	
	
		$this->Session->setFlash(__('Save keywords from csv => executed'));
	
		return $this->redirect(
				array(
						'controller' => 'keywords',
						'action' => 'index'
	
				));
	
	}//_read_CSV_Categories

	public function
	_save_Data_Keywords_from_CSV__Get_CatID_From_OrigID($orig_id, $categories) {
		
		foreach ($categories as $cat) {
		
			if ($cat['Category']['original_id'] == $orig_id) {
				
				return $cat['Category']['id'];
				
			};
		
		}
		
		return false;
		
	}//_save_Data_Keywords_from_CSV__Get_CatID_From_OrigID
	
	public function
	_save_Data_Keywords_from_CSV__KWPairs($data) {

		$kw_pairs = array();
		
		for ($i = 3; $i < count($data); $i++) {
		
			// 			if ($i < 10) {
		
			// 				Utils::write_Log(
			// 					Utils::get_dPath_Log(),
			// 					//REF http://www.phpbook.jp/func/string/index7.html
			// 					sprintf("data[%d] => %s, %s, %s",
			// 							$i, $data[$i][0], $data[$i][1], $data[$i][2]),
			// 					__FILE__, __LINE__);
		
			// 			}
		
			$pair = array();
		
			array_push($pair, $data[$i][0]);
			array_push($pair, $data[$i][1]);
			array_push($pair, $data[$i][2]);
			array_push($pair, $data[$i][3]);
		
			array_push($kw_pairs, $pair);
		
		}
		
		// 		debug($kw_pairs[0]);
		Utils::write_Log(
		Utils::get_dPath_Log(),
		"\$kw_pairs => ".((string)count($kw_pairs)),
		__FILE__, __LINE__);
		
		return $kw_pairs;
		
	}//_save_Data_Keywords_from_CSV__CatPairs

	public function
	delete_all() {
	
		//REF http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html
		if ($this->Keyword->deleteAll(array('Keyword.id >=' => 1))) {
			// 		if ($this->Category->deleteAll(array('id >=' => 1))) {
				
			$this->Session->setFlash(__('Keywords all deleted'));
			return $this->redirect(array('action' => 'index'));
				
		} else {
	
			$this->Session->setFlash(__('Keywords not deleted'));
			return $this->redirect(array('action' => 'index'));
	
		}
	
	}//delete_all

	public function
	add_KW__Genre_Changed() {
		
		//REF http://stackoverflow.com/questions/10878321/different-layouts-on-different-views-cakephp-2-0 answered Jun 4 '12 at 8:28
		//REF http://learn.jquery.com/using-jquery-core/faq/how-do-i-get-the-text-value-of-a-selected-option/
		$this->layout = 'plain_1';
		
		$id = @$this->request->query['id'];

		/**********************************
		* categories
		**********************************/
		$select_Categories = $this->_get_Selector_Category_From_GenreID($id);
		
		$this->set('select_Categories', $select_Categories);		

		//REF http://stackoverflow.com/questions/11711385/rendering-controller-to-a-different-view-in-cakephpanswered Jul 30 '12 at 5:10
		$this->render("js/add_KW__Genre_Changed");
// 		return $this->redirect(array('action' => 'index'));
		
	}
}