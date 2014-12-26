<?php

class EqsController extends AppController {
	public $helpers = array('Html', 'Form');

	public $components = array('Paginator');
	
	public function 
	index() {
		/**********************************
		* setup: pagination
		**********************************/
		$page_limit = 10;
		
		$opt_order = array(
				
// 				'Eq.mag' => 'desc',
// 				'Eq.time_eq' => 'desc',
				'Eq.time_eq_serial' => 'desc',
// 				'Eq.id' => 'asc',
		
		);
		
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

		// eqs
		$this->set('eqs', $this->paginate('Eq'));
		
		/**********************************
		* meta infos
		**********************************/
		// total number
		$num_of_tokens = count($this->Eq->find('all'));
		$this->set('num_of_tokens', $num_of_tokens);
		
		// total number of pages
		$num_of_pages = (int) ceil($num_of_tokens / $page_limit);
		$this->set('num_of_pages', $num_of_pages);
		
// 		$this->set('eqs', $this->Eq->find('all'));

// 		// eqs
// 		$this->set('eqs', $this->paginate('Eq'));
		
		$eqs = $this->_get_Eqs();
// 		$eqs = $this->_index__Get_EqInfo();
		
	}//index

	public function
	_index__Get_EqInfo() {
		
		$url_base = "http://typhoon.yahoo.co.jp";
// 		$url_base = "http://typhoon.yahoo.co.jp/weather/jp/earthquake";
		
		$url = "$url_base/weather/jp/earthquakelist/";
// 		$url = "$url_base/list/";
// 		$url = "http://typhoon.yahoo.co.jp/weather/jp/earthquake/list/";
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
		
		$trs = $html->find('table tr');
		
		$eqs = $this->_index__Conv_Html_to_Eqs($trs, $url_base);
		
// 		$table = $html->find('table');
		
// 		if ($table != null) {
			
// 			debug(count($table));	//=> 1

// 			$trs = $html->find('table tr');
			
// 			debug(count($trs));	//=> 101
			
// 			debug(get_class($trs[0]));	//=> simple_html_dom_node
			
// 			$trs_0_children = $trs[0]->children();
			
// 			debug(count($trs_0_children));	//=> 5
			
// 			//td
// 			$td_1 = $trs_0_children[0];	// [node, node,...]

// 			debug(get_class($td_1));	//=> simple_html_dom_node
			
// 			debug($td_1->plaintext);	//=> '  発生時刻     '
			
// // 			$trs_children = $trs->children();	//=> Call to a member function children() on a non-object
			
// // 			$tds_1 = $trs[0]->children();
			
// // 			debug(get_class($tds_1[0]));	//=> simple_html_dom_node
			
// // 			$td_1 = $trs->first_child();	//=> Call to a member function first_child() on a non-object	
			
// // 			$td_1 = $trs[0]['td:first'];	//=> Cannot use object of type simple_html_dom_node as array
			
// // 			debug(array_keys($trs[0]));
// // 			debug($trs[0]);
// // 			$td = $trs->children(1);	//=> Call to a member function children() on a non-object
// // 			debug(array_keys($table));
// // 			debug(array_keys($table[0]));
// // 			debug($table[0]);
			
// // 			$trs = $table->tr;
			
// // 			debug(count($trs));
			
// 		} else {
			
// 			debug("\$table => null");
			
// 		}
		
// 		debug(get_class($table));
// 		debug($table);	//=> Allowed memory size of 134217728 bytes exhausted
		
	}//_index__Get_EqInfo
	
	public function 
	_index__Conv_Html_to_Eqs($trs, $url_base) {
		
		$eqs = array();
		
		$tr_1 = $trs[1];
		
		$tds_1 = $tr_1->children();
		
		$eq = $this->Eq->create();
		
		$eq['time_eq'] = $tds_1[0]->plaintext;
		$eq['time_pub'] = $tds_1[1]->plaintext;
		$eq['epi'] = $tds_1[2]->plaintext;
		$eq['mag'] = $tds_1[3]->plaintext;
		$eq['ss'] = $tds_1[4]->plaintext;

		//REF http://qiita.com/chkk525@github/items/3d3fba394514fa2c4529
		$a = $tds_1[0]->find('a');
		
		$href = $a[0]->href;	//=> '/weather/jp/earthquake/20141016092912.html'
		
		$eq['url_img'] = $url_base.$href;
		
		debug($eq);
		
		$a = $tds_1[0]->find('a');

		$href = $a[0]->href;	//=> '/weather/jp/earthquake/20141016092912.html'
		
// 		debug(count($a));	//=> 1
		
// 		$href = $a->href;	//=> Trying to get property of non-object
		
// 		debug($href);
		
// 		debug($a);	//=> out of memory
		
// 		debug($tds_1[0]->a);	//=> false
		
// 		$td_1 = $tds_1[0];
		
// 		$time_eq = $td_1->plaintext;
		
// 		debug($time_eq);	//=> '2014年10月15日 7時52分ごろ'
// 		debug(count($tds_1));	//=> 5
		
	}//_index__Conv_Html_to_Eqs
	
	public function 
	view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid eq'));
		}
	
		$eq = $this->Eq->findById($id);
		if (!$eq) {
			throw new NotFoundException(__('Invalid eq'));
		}
		$this->set('eq', $eq);
	}

	public function 
	add() {
		if ($this->request->is('post')) {
			$this->Eq->create();
			
			$this->request->data['Eq']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['Eq']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->Eq->save($this->request->data)) {
				$this->Session->setFlash(__('Your eqs has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			
			$this->Session->setFlash(__('Unable to add your eqs.'));
			
		} else {
			
			$option = array('class' => 'flash_ok');
			
			//REF flash bg http://hijiriworld.com/web/cakephp-setflash/
			$this->Session->setFlash(__('Add Eq'), 'default', $option);
// 			$this->Session->setFlash(__('Add Eq'));
			
		}
		
	}//add

	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid eq id'));
		}
	
		$eq = $this->Eq->findById($id);
	
		if (!$eq) {
			throw new NotFoundException(__("Can't find the eq. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->Eq->delete($id)) {
			// 		if ($this->Eq->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"Eq deleted => %s",
					$eq['Eq']['epi']));
	
			return $this->redirect(
					array(
							'controller' => 'eqs',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("Eq can't be deleted => %s",
							$eq['Eq']['epi']));
	
			// 			$page_num = _get_Page_from_Id($id - 1);
	
			return $this->redirect(
					array(
							'controller' => 'eqs',
							'action' => 'view',
							$id
					));
	
		}
	
	}//public function delete($id)

	public function edit($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid text'));
		}
	
		/****************************************
			* Langs data
		****************************************/
		$this->loadModel('Lang');
			
		$langs = $this->Lang->find('all');
			
		// 			debug($langs);
			
		$select_Langs = array();
			
		foreach ($langs as $lang) {
	
			$lang_Name = $lang['Lang']['name'];
			$lang_Id = $lang['Lang']['id'];
	
			$select_Langs[$lang_Id] = $lang_Name;
	
		}
			
		// 			debug($select_Langs);
			
		$this->set('select_Langs', $select_Langs);
	
		/****************************************
			* Text
		****************************************/
		$text = $this->Text->findById($id);
		if (!$text) {
			throw new NotFoundException(__('Invalid text'));
		}
	
		// 		debug($this->request);
	
		// 		if ($this->request->is(array('text', 'put'))) {
			
		$this->Text->id = $id;
			
		if ($this->Text->save($this->request->data)) {
	
			$this->Session->setFlash(__('Your text has been updated.'));
			return $this->redirect(
					array(
							'action' => 'view',
							$id));
	
		}//if ($this->Text->save($this->request->data))
			
		$this->Session->setFlash(__('Unable to update your text.'));
			
			// 		} else {
	
		// 			$this->Session->setFlash(__(
		// 					"Sorry. \$this->request->is(array('text', 'put')) => Not true"));
	
		// 		}//if ($this->request->is(array('text', 'put')))
	
		if (!$this->request->data) {
			$this->request->data = $text;;
		}
	
	}//public function edit($id = null)

	public function map() {
		
		$this->layout = 'plain';
		
	}
	
	public function
	delete_all() {
	
		//REF http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html
		if ($this->Eq->deleteAll(array('Eq.id >=' => 1))) {
			// 		if ($this->Category->deleteAll(array('id >=' => 1))) {
	
			$this->Session->setFlash(__('Eqs all deleted'));
			return $this->redirect(array('action' => 'index'));
	
		} else {
	
			$this->Session->setFlash(__('Eqs not deleted'));
			return $this->redirect(array('action' => 'index'));
	
		}
	
	}//delete_all

	public function
	_get_Eqs() {

// 		$url_base = "http://typhoon.yahoo.co.jp/weather/jp/earthquake";

// 		$url = "$url_base/list/";
// 		// 		$url = "http://typhoon.yahoo.co.jp/weather/jp/earthquake/list/";

		$url_base = "http://typhoon.yahoo.co.jp";
		// 		$url_base = "http://typhoon.yahoo.co.jp/weather/jp/earthquake";
		
		$url = "$url_base/weather/jp/earthquake/list/";
		
		debug($url);
		
		//REF http://sourceforge.net/projects/simplehtmldom/files/simplehtmldom/1.5/
		$html = file_get_html($url);
		
		$trs = $html->find('table tr');
		
		return $this->_conv_TrTags_to_Eqs($trs, $url_base);
// 		$eqs = $this->_conv_TrTags_to_Eqs($trs, $url_base);
		
	}//_get_Eqs

	public function
	_conv_TrTags_to_Eqs
	($trs, $url_base) {
		
		$eqs = array();

		for ($i = 1; $i < count($trs); $i++) {
			
			// get tr
			$tr = $trs[$i];
			
			// get tds
			$tds = $tr->children();
			
			// create eq
			$eq = $this->Eq->create();
			
			// set: values
			$eq['time_eq'] = $tds[0]->plaintext;
			$eq['time_pub'] = $tds[1]->plaintext;
			$eq['epi'] = $tds[2]->plaintext;
			$eq['mag'] = $tds[3]->plaintext;
			$eq['ss'] = $tds[4]->plaintext;
			
			$a = $tds[0]->find('a');
			
			$href = $a[0]->href;	//=> '/weather/jp/earthquake/20141016092912.html'
			
			$eq['url_img'] = $url_base.$href;
			
			$eq['time_eq_serial'] = $this->_conv_TimeEQ_to_Serial($eq['time_eq']);;
				
			// push
			array_push($eqs, $eq);
			
		}
		
// 		debug(count($eqs));
		
// 		debug($eqs[50]);
		
		$tr_1 = $trs[1];
		
		$tds_1 = $tr_1->children();
		
		$eq = $this->Eq->create();
		
		$eq['time_eq'] = $tds_1[0]->plaintext;
		$eq['time_pub'] = $tds_1[1]->plaintext;
		$eq['epi'] = $tds_1[2]->plaintext;
		$eq['mag'] = $tds_1[3]->plaintext;
		$eq['ss'] = $tds_1[4]->plaintext;
		
		$a = $tds_1[0]->find('a');
		
		$href = $a[0]->href;	//=> '/weather/jp/earthquake/20141016092912.html'
		
		$eq['url_img'] = $url_base.$href;
		
		debug($eq);

		$time_eq_serial = $this->_conv_TimeEQ_to_Serial($eq['time_eq']);
		
		debug($time_eq_serial);
		
		/**********************************
		* return
		**********************************/
		return $eqs;
		
	}//_conv_TrTags_to_Eqs

	public function
	save_eqs() {

		$counter = 0;
		
		/**********************************
		* get: list
		**********************************/
		$eq_list = $this->_get_Eqs();
		
// 		http://typhoon.yahoo.co.jp/weather/jp/earthquake/weather/jp/earthquake/20141016080227.html
// 		http://typhoon.yahoo.co.jp/weather/jp/earthquake/20141016092912.html
		/**********************************
		* save
		**********************************/
		foreach ($eq_list as $item) {
		
			$this->Eq->create();
		
			// build param
			$param = array('Eq' =>
			
					array(
								
							'created_at'	=> Utils::get_CurrentTime(),
							'updated_at'	=> Utils::get_CurrentTime(),
								
							'time_eq'		=> $item['time_eq'],
							'time_pub'		=> $item['time_pub'],
							'epi'		=> $item['epi'],
							'mag'		=> $item['mag'],
							'ss'		=> $item['ss'],
							'url_img'		=> $item['url_img'],
							'time_eq_serial'	=> $item['time_eq_serial'],
								
								
					)//array(
			
			);//$param = array('Eq' =>
				
			if ($this->Eq->save($param)) {
			
				$counter += 1;
			
			}
				
		}//foreach ($item as $eq_list)
		
		/**********************************
		* redirect
		**********************************/
		$this->Session->setFlash(__("Eqs saved => ".$counter));
		
		//log
		$msg = "Save eqs done => ".(string)$counter;
		Utils::write_Log($this->path_Log, $msg, __FILE__, __LINE__);
		
		
		return $this->redirect(
					array(
						'controller'	=> 'eqs',
						'action' =>		'index'
					)
		);
		
	}//save_eqs

	public function
	_conv_TimeEQ_to_Serial
	($time_eq) {
		
		$p = "/\d+/i";
		
		$res = preg_match_all($p, $time_eq, $matches);
		
		/**********************************
		 * matches?
		**********************************/
		if ($res == 0) {
		
			return $time_eq;
			
// 			echo "no matches";
// 			echo "\n";
		
		} else if ($res == FALSE) {
		
			return $time_eq;
			
// 			echo "FALSE";
// 			echo "\n";
		
		} else {
		
// 			echo "res => ";
			// 		print_r($matches);
			// 		print_r($matches[0]);
		
			return $this->_conv_Match_to_DateLabel($matches[0]);
		
		}
		
	}//_conv_TimeEQ_to_Serial

	public function
	_conv_Match_to_DateLabel
	($match) {
		
		for ($i = 0; $i < count($match); $i++) {
		
			$num_str = (string) $match[$i];
		
			$len = strlen($num_str);
		
			if ($len == 1) {
					
				$num_str = "0".$num_str;
					
			}
		
			$match[$i] = $num_str;
		
		}

		$label = implode("", array_slice($match, 0, 3))
				."_"
				.implode("", array_slice($match, 3))
				;
		
		return $label;
// 		return implode("_", $match);
		
	}//_conv_Match_to_DateLabel

}