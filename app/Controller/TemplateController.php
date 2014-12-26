<?php

class GenresController extends AppController {
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->set('genres', $this->Genre->find('all'));
	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid genre'));
		}
	
		$genre = $this->Genre->findById($id);
		if (!$genre) {
			throw new NotFoundException(__('Invalid genre'));
		}
		$this->set('genre', $genre);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->Genre->create();
			
			$this->request->data['Genre']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['Genre']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->Genre->save($this->request->data)) {
				$this->Session->setFlash(__('Your genres has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your genres.'));
		}
	}

	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid genre id'));
		}
	
		$genre = $this->Genre->findById($id);
	
		if (!$genre) {
			throw new NotFoundException(__("Can't find the genre. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->Genre->delete($id)) {
			// 		if ($this->Genre->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"Genre deleted => %s",
					$genre['Genre']['name']));
	
			return $this->redirect(
					array(
							'controller' => 'genres',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("Genre can't be deleted => %s",
							$genre['Genre']['name']));
	
			// 			$page_num = _get_Page_from_Id($id - 1);
	
			return $this->redirect(
					array(
							'controller' => 'genres',
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

	public function
	delete_all() {
	
		//REF http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html
		if ($this->Genre->deleteAll(array('Genre.id >=' => 1))) {
			// 		if ($this->Category->deleteAll(array('id >=' => 1))) {
	
			$this->Session->setFlash(__('Genres all deleted'));
			return $this->redirect(array('action' => 'index'));
	
		} else {
	
			$this->Session->setFlash(__('Genres not deleted'));
			return $this->redirect(array('action' => 'index'));
	
		}
	
	}//delete_all
	
}