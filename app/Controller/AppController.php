<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	//REF global variable http://stackoverflow.com/questions/12638962/global-variable-in-controller-cakephp-2
	public $path_Log;
	
	public $path_Utils;
	
	public $path_BackupUrl_Text;
	
	public $fpath_Log;
	
	public $path_Docs;
	
	public $fname_Utils		= "utils.php";
	
	public $title_Length	= 60;
	
	public function 
	beforeFilter() {
	
		$this->_Setup_Paths();
	
// 		require_once $this->path_Utils.DS.$this->fname_Utils;
		// 		require $this->path_Utils.DS.$this->fname_Utils;
	
		require_once $this->path_Utils.DS."CONS.php";
	
		require_once $this->path_Utils.DS."utils.php";
		
		require_once $this->path_Utils.DS."simple_html_dom.php";
	
// 		require_once $this->path_Utils.DS."db_util.php";
	
// 		$this->Auth->allow('index', 'view');
// 		$this->Auth->allow('index', 'view', 'open_article');
		
	}//beforeFilter
	
	private function _Setup_Paths() {
		/****************************************
			* Build: Paths
		****************************************/
		$this->path_Log = join(DS, array(ROOT, "lib", "log"));
		// 		$this->path_Log = join(DS, array(ROOT, APP_DIR, "Lib", "log"));
	
		$this->fpath_Log = join(DS, array(ROOT, "lib", "log", "log.txt"));
	
		$this->path_Utils = join(DS, array(ROOT, APP_DIR, "Lib", "utils"));
	
		$this->path_Docs = join(DS, array(ROOT, APP_DIR, "Lib", "docs"));
	
		$this->path_Data = join(DS, array(ROOT, APP_DIR, "Lib", "data"));
	
		$this->path_BackupUrl_Text =
		"http://localhost/PHP_server/CR6_cake/texts/add";
		// 						"http://localhost/PHP_server/CR6_cake/texts/index";
	
		/****************************************
		 * Create dir: log
		****************************************/
		//REF recursive http://stackoverflow.com/questions/2795177/how-to-convert-boolean-to-string
		// 		$res = mkdir($path_Log.DS."loglog", $mode=0777, $recursive=false);
	
		$res = false;
	
		if (!file_exists($this->path_Log)) {
	
			$res = @mkdir($this->path_Log, $mode=0777, $recursive=true);
	
		}
	
		/****************************************
		 * Create dir: utils
		****************************************/
		$res2 = false;
	
		if (!file_exists($this->path_Utils)) {
	
			$res = @mkdir($this->path_Utils, $mode=0777, $recursive=true);
	
		}
	
		/****************************************
		 * Create dir: utils
		****************************************/
		if (!file_exists($this->path_Docs)) {
	
			$res = @mkdir($this->path_Docs, $mode=0777, $recursive=true);
	
		}
	
	
	}//public function _Setup_Paths()

// 	public $components = array(
// 			'Session',
// 			'Auth' => array(
// 					'loginRedirect' => array(
// 							'controller' => 'videos',
// // 							'controller' => 'posts',
// 							'action' => 'index'
// 					),
// 					'logoutRedirect' => array(
// 							'controller' => 'videos',
// 							'action' => 'index'
// // 							'action' => 'display',
// // 							'home'
// 					)
// 			)
// 	);

	public function
	build_Text_Colorize_Kanji
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
					$content .="<font color=\"blue\"><b>".$str."</b></font>";
// 					$content .="<font color=\"darkgreen\"><b>".$str."</b></font>";
// 					$content .="<font color=\"darkgreen\">".$str."</font>";
					// 					$content .="<font color=\"green\">".$str."</font>";
						
					break;
	
				case 2:	// hiragana
					// blue
					// 					$content .="<font color=\"#7368EF\">".$str."</font>";
					// 					$content .="<font color=\"#9F9CBC\">".$str."</font>";
					$content .="<font color=\"black\"><b>".$str."</b></font>";
// 					$content .="<font color=\"blue\"><b>".$str."</b></font>";
// 					$content .="<font color=\"blue\">".$str."</font>";
						
					break;
						
				case 3:	// katakana
						
					$content .="<font color=\"purple\"><b>".$str."</b></font>";
// 					$content .="<font color=\"purple\">".$str."</font>";
					// 					$content .="<font color=\"palevioletred\">".$str."</font>";
					// 					$content .="<font color=\"green\">".$str."</font>";
					// 					$content .="<font color=\"#B5A243\">".$str."</font>";
						
					break;
	
				case 4:	// number
						
					$content .="<font color=\"darkgreen\"><b>".$str."</b></font>";
// 					$content .="<font color=\"#575757\"><b>".$str."</b></font>";
						
					break;
	
				case 0:
						
// 					$content .= $str;
					$content .= "<b>".$str."</b>";
						
					break;
	
				default:
						
					$content .= "<b>".$str."</b>";
// 					$content .= $str;
						
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
	get_Admin_Value
	($key, $val_1) {
		
		$this->loadModel('Admin');
		
		$option = array(
					
				'conditions'	=> array(
						'Admin.name LIKE'	=> $key
				)
		);
		
		// 		$admin = $this->Admin->find('first');
		$admin = $this->Admin->find('first', $option);
		
		// 		debug($admin);
		
		return @$admin['Admin'][$val_1];
		
	}//get_Admin_Value

	public function
	build_Text
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
	get_Words($text) {
	
		$sen = $this->_sanitize($text);
	
		$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
	
		//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
		$xml = simplexml_load_file($url);
	
		$words = $xml->word;
	
// 		$this->set("word", $words[10]->surface);
	
		return $words;
	
	}//_view_Mecab
	
	public function
	_sanitize
	($str, $tag="font") {
	
		$tag = "font";
		$p = "/<$tag.+?>(.+)<\/$tag>/";
	
		$rep = '${1}';
	
		return preg_replace($p, $rep, $str);
	
	}

	/**********************************
	 * divide text with "。"
	**********************************/
	public function
	content_multilines_GetHtml
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

// 	public $components = array(
// 			'Session',
// 			'Auth' => array(
// 					'loginRedirect' => array(
// 							'controller' => 'articles',
// 							// 							'controller' => 'posts',
// 							'action' => 'index'
// 					),
// 					'logoutRedirect' => array(
// 							'controller' => 'articles',
// 							'action' => 'index'
// 							// 							'action' => 'display',
// 	// 							'home'
// 					)
// 			)
// 	);
	
}//class AppController extends Controller
