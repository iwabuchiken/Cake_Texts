<?php

class UsersController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
// 		$this->Auth->allow('add');
// 		$this->Auth->allow('add', 'logout');
		$this->Auth->allow('add_user', 'logout');
// 		$this->Auth->allow('add_user', 'logout', 'open_article');
		
	}

	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	public function view($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__(
								"Welcome ".$this->request->data['User']['username']));
				
// 				$this->Session->setFlash(__('The user has been saved'));
				
				return $this->redirect(array('action' => 'index'));
// 				return $this->redirect(
// 							array(
// 								'controller'	=> 'articles',
// 								'action' => 'index'
// 							)
// 				);
				
			}
			$this->Session->setFlash(
					__('The user could not be saved. Please, try again.')
			);
		}
	}

	public function add_user() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(
						__("Welcome ".$this->request->data['User']['username']),
						
						//REF http://stackoverflow.com/questions/7990503/cakephp-customize-flash-message answered Nov 3 '11 at 7:54
						'flash_views/ok'
// 						'ok'	//=> Element Not Found
				);
// 								"Welcome ".$this->request->data['User']['username']));
				
// 				$this->Session->setFlash(__('The user has been saved'));
				
				return $this->redirect(array('action' => 'index'));
// 				return $this->redirect(
// 							array(
// 								'controller'	=> 'articles',
// 								'action' => 'index'
// 							)
// 				);
				
			}
			$this->Session->setFlash(
					__('The user could not be saved. Please, try again.')
			);
			
		}
		
		$this->render("add");
// 		$this->render("users/add");	//=> The view for UsersController::add_user() was not found.
		
// 		} else {
			
// 			return $this->redirect(array('action' => 'add'));
// 		}
	}

	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(
					__('The user could not be saved. Please, try again.')
			);
		} else {
			$this->request->data = $this->User->read(null, $id);
			unset($this->request->data['User']['password']);
		}
	}

	public function delete($id = null) {
		$this->request->onlyAllow('post');

		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			return $this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		return $this->redirect(array('action' => 'index'));
	}

	public function login() {
		if ($this->request->is('post')) {
			
// 			//debug
// 			debug($this->Auth->login());
			
			if ($this->Auth->login()) {
				return $this->redirect($this->Auth->redirect());
			}
			$this->Session->setFlash(__('Invalid username or password, try again'));
		}
	}
	
	public function logout() {
		return $this->redirect($this->Auth->logout());
	}

}//class UsersController extends AppController
