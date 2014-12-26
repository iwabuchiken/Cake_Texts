<?php

class HistorysController extends AppController {
	public $helpers = array('Html', 'Form');

	public $components = array('Paginator');
	
	public function index() {

		/**********************************
		 * paginate
		**********************************/
		$page_limit = 10;
		
		$opt_order = array('History.id' => 'asc');
		
		$opt_conditions = '';
		
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
		
		$this->set('historys', $this->paginate('History'));
		
		$num_of_histories = count($this->History->find('all'));
		
		$this->set('num_of_histories', $num_of_histories);
		
		$this->set('num_of_pages', (int) ceil($num_of_histories / $page_limit));
		
		
// 		$this->set('historys', $this->History->find('all'));

	}
	
	public function 
	view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid history'));
		}
	
		$history = $this->History->findById($id);
		if (!$history) {
			throw new NotFoundException(__('Invalid history'));
		}
		
		$this->set('history', $history);
		
		/**********************************
		* content: modified
		**********************************/
		$words = $this->_view_Mecab($history);

// 		$content_multiline = 
// 				$this->_content_multilines_GetHtml($history['History']['content']);
		
		$val_1 = $this->get_Admin_Value(CONS::$admin_Colorize, "val1");
		
		if ($val_1 == null || !is_numeric($val_1) || intval($val_1) == 1) {
				
			$content_multiline = $this->build_Text($words);
// 			$content_multiline = $this->_build_Text($words);
			
		} else {
				
			$content_multiline = $this->build_Text_Colorize_Kanji($words);
// 			$content_multiline = $this->_build_Text_Colorize_Kanji($words);
				
		}
		
// 		debug($content_multiline);
		
		$content_multiline =
				$this->_content_multilines_GetHtml($content_multiline);
		
		$this->set('content_html', $content_multiline);
		
		/**********************************
		* mecab
		**********************************/
// 		$this->_view_Mecab($history);
		
	}//view($id = null)

	public function 
	_build_Text_Colorize_Kanji
	($words) {

		//test
		$tmp = $words[10];

		$tmp_str = (string)$tmp->surface;
		
// 		debug(preg_split('//u', $tmp_str));
		
// 		for ($i = 0; $i < mb_strlen($tmp_str); $i++) {
// 		for ($i = 0; $i < mb_strlen((string)$tmp->surface)); $i++) {
// 		foreach (str_split as item) {
		
// 			debug($tmp_str[$i]);
			
// 		}
// 		debug(mb_strlen((string)$tmp->surface));
// 		debug((string)$tmp->surface);
// 		foreach ((string)$tmp->surface as $chr) {
		
// 			debug($chr);
		
// 		}
		
// 		debug($tmp);
		
		
		
		$content = "";
		
// 		$str = $words->surface;
		
		foreach ($words as $w) {
		
			$str = $w->surface;
			
// 			debug(mb_split('', $str));
// 			debug(preg_split('//u', mb_convert_encoding($str, "UTF-8")));
// 			debug(preg_split('//u', $str));
// 			debug(preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY));
			
			$res = Utils::get_Type($str);

// 			debug((string)$str);
// 			debug(mb_strlen((string)$str));
// 			debug(strlen((string)$str));
// 			debug((string)$str)[1];
// 			debug($res);
			
			//REF color names http://www.colordic.org/
			
			switch ($res) {
				case 1:
					
// 					$content .="<font color=\"black\">".$str."</font>";
					$content .="<font color=\"darkgreen\">".$str."</font>";
// 					$content .="<font color=\"green\">".$str."</font>";
					
					break;
				
				case 2:	// hiragana
					// blue
// 					$content .="<font color=\"#7368EF\">".$str."</font>";
// 					$content .="<font color=\"#9F9CBC\">".$str."</font>";
					$content .="<font color=\"blue\">".$str."</font>";
					
					break;
					
				case 3:	// katakana
					
					$content .="<font color=\"purple\">".$str."</font>";
// 					$content .="<font color=\"palevioletred\">".$str."</font>";
// 					$content .="<font color=\"green\">".$str."</font>";
// 					$content .="<font color=\"#B5A243\">".$str."</font>";
					
					break;
				
				case 4:	// number
					
					$content .="<font color=\"#575757\">".$str."</font>";
					
					break;
				
				case 0:
					
					$content .= $str;
					
				break;
				
				default:
					
					$content .= $str;
					
				break;
				
			}
		
// 			$res = Utils::isKanji_All($w->surface);
			
// 			if ($res == true) {
				
// 				$content .="<font color=\"green\">".$w->surface."</font>";
				
// 			} else {
				
// 				$content .=$w->surface;
				
// 			}
		
		}//foreach ($words as $w)
		
		return $content;
		
		
	}//_build_Text_Colorize_Kanji
	
	public function 
	_build_Text
	($words) {

		//test
		$tmp = $words[10];

		$tmp_str = (string)$tmp->surface;
		
		$content = "";
		
		foreach ($words as $w) {
		
			$str = $w->surface;
			
			$content .= $str;
			
		}//foreach ($words as $w)
		
		return $content;
		
	}//_build_Text
	
	public function 
	_view_Mecab($history) {
		
		$sen = $this->sanitize($history['History']['content']);
		
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";

		//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
		$xml = simplexml_load_file($url);

		$words = $xml->word;
		
		$this->set("word", $words[10]->surface);
		
		return $words;
		
	}//_view_Mecab
	
	public function 
	add() {
		if ($this->request->is('post')) {
			$this->History->create();
			
			$this->request->data['History']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['History']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->History->save($this->request->data)) {
				$this->Session->setFlash(__('Your historys has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('Unable to add your historys.'));
			
		} else {
			
			$select_Genres = Utils::_get_Selector_Genre();
// 			$select_Genres = $this->_get_Selector_Genre();
			
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
					Utils::_get_Selector_Category_From_GenreID($genre_id);
			
			$this->set('select_Categories', $select_Categories);
			
			$this->set('genre_id', $genre_id);
			
		}//if ($this->request->is('post'))
			
	}//add

	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid history id'));
		}
	
		$history = $this->History->findById($id);
	
		if (!$history) {
			throw new NotFoundException(__("Can't find the history. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->History->delete($id)) {
			// 		if ($this->Genre->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"History deleted => %s",
					$history['History']['line']));
	
			return $this->redirect(
					array(
							'controller' => 'historys',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("History can't be deleted => %s",
							$history['History']['line']));
	
			// 			$page_num = _get_Page_from_Id($id - 1);
	
			return $this->redirect(
					array(
							'controller' => 'historys',
							'action' => 'view',
							$id
					));
	
		}
	
	}//public function delete($id)

	public function
	sanitize
	($str, $tag="font") {
	
		$tag = "font";
		$p = "/<$tag.+?>(.+)<\/$tag>/";
	
		$rep = '${1}';
	
		return preg_replace($p, $rep, $str);
	
	}

	public function
	save_Tokens
	($id = null) {

		if (!$id) {
			throw new NotFoundException(__('Invalid history id'));
		}

		/**********************************
		* create: tokens
		**********************************/
		$history = $this->History->findById($id);
		
			if (!$history) {
				
				throw new NotFoundException(__('Invalid history'));
				
		}

		/**********************************
		* get: words list
		**********************************/
		$words= $this->get_Mecab_WordList($history['History']['content']);

		/**********************************
		* conv: words to tokens
		**********************************/
		$tokens = $this->conv_MecabWords_to_Tokens($words);

		/**********************************
		* save: tokens
		**********************************/
		$res = $this->save_token_list($tokens, $history['History']['id']);

		if ($words != null) {
			
			$msg_Flash = "save_Tokens => done. Words => ".count($words)
						." \$words[10] => ".$words[10]->surface
						." / "
						."Tokens => ".count($tokens)
						." \$tokens[10] => ".$tokens[10]->form
						." / "
						."\$tokens[10]->hin => ".$tokens[10]->hin
						."/"
						."save token => ".$res
						;
			$this->Session->setFlash(__($msg_Flash));
			
		} else {
			
			$this->Session->setFlash(__("save_Tokens => done. Words => null"));
			
		}
		
		$this->set('tokens', $tokens);
		
// 		$this->redirect(array('action' => 'view', $id));
// 		$this->redirect(array('action' => 'view', $id));
		
	}//save_Tokens
	
	public function
	save_token_list
	($tokens, $history_id) {
		
		$counter = 0;
		
		$this->loadModel('Token');
	
		foreach ($tokens as $token) {
	
			$this->Token->create();

// 			$cat_id = $this->_save_Data_Keywords_from_CSV__Get_CatID_From_OrigID(
// 								$kw_pair[3], $categories);
			
// 			// valiate
// 			if ($cat_id == false) {
				
// 				continue;
				
// 			}
			
			// build param
			$param = array('Token' =>
						
					array(
							
							'created_at'	=> Utils::get_CurrentTime(),
							'updated_at'	=> Utils::get_CurrentTime(),
							
							'form'			=> $token->form,
							
							'hin'			=> $token->hin,
							'hin_1'			=> $token->hin_1,
							'hin_2'			=> $token->hin_2,
							'hin_3'			=> $token->hin_3,
							
							'katsu_kei'		=> $token->katsu_kei,
							'katsu_kata'	=> $token->katsu_kata,
							'genkei'		=> $token->genkei,
							'yomi'			=> $token->yomi,
							'hatsu'			=> $token->hatsu,
							
							'history_id'			=> $history_id,
							
					)
						
			);
			
			if ($this->Token->save($param)) {
	
				$counter += 1;
	
			}

// 			//test
// 			if ($counter > 20) {
				
// 				break;
				
// 			}
			
		}//foreach ($cat_pairs as $cat_pair)

		return $counter;
		
	}//save_token_list
	
	public function
	conv_MecabWords_to_Tokens
	($words) {
		
		$token_list = array();
		
		$counter = 0;
		
		foreach ($words as $w) {
		
			$token = new Token();

			/**********************************
			* form
			**********************************/
			$token->form = $w->surface;
// 			$token->form = $w->surface;

			/**********************************
			* features
			**********************************/
// 			$token->hin = $w->feature;
			
			$tmp = explode(',', (string)$w->feature);
// 			$tmp = explode(',', $w->feature);

// 			if ($counter < 20) {

// 				debug((string)$w->surface);
// 				debug((string)$w->feature);
// // 				debug($w->surface);

// // 				break;
// 			}
					
			
			
// 			//log
// 			$msg = "count(\$tmp) => " + count($tmp);
// 			Utils::write_Log($this->path_Log, $msg, __FILE__, __LINE__);
			
// 			debug($tmp);

// 			if ($counter < 20) {
			
// 				debug($tmp);
// 				// 				debug($w->surface);
			
// 				// 				break;
// 			}
				
			if ($tmp == null || count($tmp) == 7 ) {
// 			if ($tmp == null || count($tmp) < 9) {
				
				$token->hin		= $tmp[0];
				
				$token->hin_1	= $tmp[1];
				$token->hin_2	= $tmp[2];
				$token->hin_3	= $tmp[3];
				
				$token->katsu_kei	= $tmp[4];
				$token->katsu_kata	= $tmp[5];
				$token->genkei	= $tmp[6];
				$token->yomi	= "*";
				
				$token->hatsu	= "*";
				
// 				debug($w->feature);
				
// 				continue;
				
			} else if (count($tmp) == 9) {
				
				$token->hin		= $tmp[0];
				
				$token->hin_1	= $tmp[1];
				$token->hin_2	= $tmp[2];
				$token->hin_3	= $tmp[3];
				
				$token->katsu_kei	= $tmp[4];
				$token->katsu_kata	= $tmp[5];
				$token->genkei	= $tmp[6];
				$token->yomi	= $tmp[7];
				
				$token->hatsu	= $tmp[8];
				
			} else {
				
				continue;
				
			}
			
			/**********************************
			* hin
			**********************************/
			
			
			
			array_push($token_list, $token);
		
			//test
			$counter += 1;
			
// 			if ($counter < 10) {
				
// 				debug($token);
				
// // 				break;
// 			}
			
		}//foreach ($words as $w)
		
		return $token_list;
		
	}//conv_MecabWords_to_Tokens
	
	public function
	get_Mecab_WordList
	($text) {
		
		$sen = $this->sanitize($text);
		
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
		
		//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
		$xml = simplexml_load_file($url);
		
		return $xml->word;
		
	}//get_MecabList	

	public function
	content_multilines
	($id = null) {
		
// 		$q = $this->request->query;
		
// 		debug($q);
		
		$this->layout = 'plain_1';

		/**********************************
		* get: id
		**********************************/
		$id_get = @$this->request->query['id'];
		
// 		debug($id_get);
		
// 		$this->Session->setFlash(__('Your historys has been saved.'));
		
		
		if ($id_get == null) {
			
			$msg = "null";
			
			$this->set("msg", $msg);
			
			$this->render("error");
			
// 			$this->set("history_id", $id);
			
// 			$this->Session->setFlash(__("id is ".$id));
// 			$this->Session->setFlash(__('id is null'));
			
// 			$this->render("Layouts/plain_1");
// 			$this->render("plain_1");
// 			$this->render("AAA", "plain_1");
			
		} else {
			
			$this->set("history_id", $id_get);
			
			$history = $this->History->findById($id_get); 
			
			if ($history == null) {
				
				$msg = "unknown id => ".$id_get;
				
				$this->set("msg", $msg);
				
				$this->render("error");
				
				return;
				
			}
			
// 			debug($history);
			$content_html = $this->_content_multilines_GetHtml(
								$history['History']['content']);
			
			$this->set("content_html", $content_html);
// 			$this->set("content", $history['History']['content']);
// 			$this->Session->setFlash(__("id is ".$id));
// 			$this->render("plain_1");
// 			$this->render("no id", "plain_1");
			
		}
		
	}//content_multilines
	
	/**********************************
	* divide text with "。"
	**********************************/
	public function
	_content_multilines_GetHtml
	($content) {
		
		$lines = explode("。", $content);
		
		$lines_new = array();
		
		foreach ($lines as $line) {
		
			$tmp = $line."。"."<br>";
			
			$space = "";
			
			for ($i = 0; $i < 10; $i++) {
				$space .="&nbsp;";
			}
			
			$tmp = str_replace(
						"、",
// 						"、<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", 
						"、<br>".$space, 
						$tmp);
			
			array_push($lines_new, $tmp);
		
		}
		
		return implode("", $lines_new);
		
	}//_content_multilines_GetHtml
	
}