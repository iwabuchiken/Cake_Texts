<?php

class SkimmedTokensController extends AppController {
	public $helpers = array('Html', 'Form');

	public $components = array('Paginator');
	
	public function index() {
		
		/**********************************
		 * paginate
		**********************************/
		$page_limit = 10;
		
		$opt_order = array(
						'SkimmedToken.id' => 'asc',
// 						'SkimmedToken.hin' => 'asc',
// 						'SkimmedToken.hin_1' => 'asc'
				
		
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
		
		$this->set('skimmedtokens', $this->paginate('SkimmedToken'));
		
		$num_of_tokens = count($this->SkimmedToken->find('all'));
		$this->set('num_of_tokens', $num_of_tokens);
		
		$this->set('num_of_pages', (int) ceil($num_of_tokens / $page_limit));
		
// 		$this->set('skimmedtokens', $this->SkimmedToken->find('all'));

	}
	
	public function view($id = null) {
		if (!$id) {
			throw new NotFoundException(__('Invalid token'));
		}
	
		$token = $this->SkimmedToken->findById($id);
		if (!$token) {
			throw new NotFoundException(__('Invalid token'));
		}
		$this->set('token', $token);
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->SkimmedToken->create();
			
			$this->request->data['SkimmedToken']['created_at'] = Utils::get_CurrentTime();
			$this->request->data['SkimmedToken']['updated_at'] = Utils::get_CurrentTime();
			
			if ($this->SkimmedToken->save($this->request->data)) {
				$this->Session->setFlash(__('Your skimmedtokens has been saved.'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('Unable to add your skimmedtokens.'));
		}
	}

	public function edit($id = null) {
		
		if (!$id) {
			throw new NotFoundException(__('Invalid text'));
		}
	
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
	
	public function delete($id) {
		/******************************
	
		validate
	
		******************************/
		if (!$id) {
			throw new NotFoundException(__('Invalid token id'));
		}
	
		$token = $this->SkimmedToken->findById($id);
	
		if (!$token) {
			throw new NotFoundException(__("Can't find the token. id = %d", $id));
		}
	
		/******************************
	
		delete
	
		******************************/
		if ($this->SkimmedToken->delete($id)) {
			// 		if ($this->SkimmedToken->save($this->request->data)) {
	
			$this->Session->setFlash(__(
					"SkimmedToken deleted => %s",
					$token['SkimmedToken']['name']));
	
			return $this->redirect(
					array(
							'controller' => 'skimmedtokens',
							'action' => 'index'
	
					));
	
		} else {
	
			$this->Session->setFlash(
					__("SkimmedToken can't be deleted => %s",
							$token['SkimmedToken']['name']));
	
			// 			$page_num = _get_Page_from_Id($id - 1);
	
			return $this->redirect(
					array(
							'controller' => 'skimmedtokens',
							'action' => 'view',
							$id
					));
	
		}
	
	}//public function delete($id)

	public function delete_all() {
	
		//REF http://book.cakephp.org/2.0/ja/core-libraries/helpers/html.html
		if ($this->SkimmedToken->deleteAll(array('SkimmedToken.id >=' => 1))) {
// 		if ($this->SkimmedToken->deleteAll(array('id >=' => 1))) {
			
			$this->Session->setFlash(__('SkimmedTokens =>  all deleted'));
			return $this->redirect(array('action' => 'index'));
			
		} else {
	
			$this->Session->setFlash(__('SkimmedTokens =>  not deleted'));
			return $this->redirect(array('action' => 'index'));
	
		}
	
	}
		
}