<?php

	require_once 'CONS.php';
	
	class Utils {
		
		public static function 
		get_HostName() {
			
			$pieces = parse_url(Router::url('/', true));
			
			return $pieces['host'];
			
		}//public function get_HostName()
		
		public static function
		get_CurrentTime2($labelType) {
			//REF http://stackoverflow.com/questions/470617/get-current-date-and-time-in-php
			date_default_timezone_set('Asia/Tokyo');
		
			switch($labelType) {
					
				case CONS::$timeLabelTypes["rails"]:
		
					return date('Y-m-d H:i:s', time());
		
				case CONS::$timeLabelTypes["basic"]:
		
					return date('Y/m/d H:i:s', time());
		
				case CONS::$timeLabelTypes["serial"]:
		
					return date('Ymd_His', time());
						
				default:
		
					return date('Y/m/d H:i:s', time());
		
			}//switch($labelType)
		
			// 		return date('m/d/Y H:i:s', time());
		
		}//function get_CurrentTime2($labelType)

		public static function 
		write_Log($dpath, $text, $file, $line) {
		
			$max_LineNum = CONS::$logFile_maxLineNum;
		
			$path_LogFile = join(
					DS,
					array($dpath, "log.txt"));
		
			/****************************************
				* Dir exists?
			****************************************/
			if (!file_exists($dpath)) {
					
				mkdir($dpath, $mode=0777, $recursive=true);
					
			}
		
			/****************************************
				* File exists?
			****************************************/
			if (!file_exists($path_LogFile)) {
					
				// 			mkdir($path_LogFile, $mode=0777);
				//REF touch http://php.net/touch
				$res = touch($path_LogFile);
					
				if ($res == false) {
		
					return;
		
				}
					
			}
		
			/****************************************
				* File => longer than the max num?
			****************************************/
			//REF read content http://www.php.net/manual/en/function.file.php
			$lines = file($path_LogFile);
		
			$file_Length = count($lines);
		
			$log_File = null;
		
			if ($file_Length > $max_LineNum) {
		
				$dname = dirname($path_LogFile);
					
				$new_name = join(
						DS,
						array(
								$dname,
								"log"."_".Utils::get_CurrentTime2(
										CONS::$timeLabelTypes['serial'])
								.".txt")
				);
		
				$res = rename($path_LogFile, $new_name);
					
			} else {
					
			}
		
			/******************************
			
				modify: file name
			
			******************************/
			$tmp = strpos(strtolower($file), "c");
			
			if ($tmp == 0) {
				
				$file = str_replace(ROOT, "", $file);
				
			}
			
			/****************************************
				* File: open
			****************************************/
			$log_File = fopen($path_LogFile, "a");
		
			/****************************************
				* Write
			****************************************/
			// 		//REF replace http://oshiete.goo.ne.jp/qa/3163848.html
			// 		$file = str_replace(ROOT.DS, "", $file);
		
			$time = Utils::get_CurrentTime();

			/**********************************
			* modify: dir path
			**********************************/
			//REF http://stackoverflow.com/questions/2192170/how-to-remove-part-of-a-string answered Feb 3 '10 at 13:33
			$file_new = str_replace(ROOT, "", $file);
			
			/**********************************
			* write
			**********************************/
			// 		$full_Text = "[$time : $file : $line] %% $text"."\n";
			$full_Text = "[$time : $file_new : $line] $text"."\n";
// 			$full_Text = "[$time : $file : $line] $text"."\n";
		
			$res = fwrite($log_File, $full_Text);
			
			/****************************************
				* File: Close
			****************************************/
			fclose($log_File);
				
		}//function write_Log($dpath, $text, $file, $line)
		
		public static function 
		get_CurrentTime() {
			//REF http://stackoverflow.com/questions/470617/get-current-date-and-time-in-php
			date_default_timezone_set('Asia/Tokyo');
		
// 			return date('m/d/Y H:i:s.u', time());
			return date('m/d/Y H:i:s', time());
		
		}
		
		public static function 
		get_dPath_Log() {
				
			return join(DS, array(ROOT, "lib", "log"));
			// 			return join(DS, array(ROOT, "lib", "log", "log.txt"));
				
		}
		
		public static function 
		get_fPath_DB_Sqlite() {
				
			$msg = "WEBROOT_DIR => ".WEBROOT_DIR
			."/"
					."WWW_ROOT => ".WWW_ROOT;
				
			write_Log(
			CONS::get_dPath_Log(),
			// 				$this->get_dPath_Log(),
			$msg,
			__FILE__,
			__LINE__);
				
				
			return join(DS,
					array(ROOT, APP_DIR, WEBROOT_DIR, CONS::$dbName_Local));
			// 					array(ROOT, APP_DIR, WEBROOT_DIR, $this->dbName_Local));
				
		}

		public static function
		conv_Float_to_TimeLabel ($float_time) {
				
			// 			$integer = (int) $float_time;
			// 			$integer = floor($float_time) / 1;
			$integer = floor($float_time);
			// 			$integer = (int)intval($float_time, 10);
			// 			$integer = (int)intval($float_time);
			// 			$integer = intval($float_time);
			// 			$integer = (intval)floor($float_time);
			// 			$integer = floor($float_time);
				
			$decimal = $float_time - $integer;
				
			$sec_num = $integer;
			// 			$sec_num = parseInt($float_time, 10); // don't forget the $second param
			$hours   = floor($sec_num / 3600);
			$minutes = floor(($sec_num - ($hours * 3600)) / 60);
			$seconds = $sec_num - ($hours * 3600) - ($minutes * 60);
		
			if ($hours   < 10) {$hours_str   = "0$hours";}
			else {$hours_str = $hours;}
		
			if ($minutes < 10) {$minutes_str = "0$minutes";}
			else {$minutes_str = $minutes;}
				
			if ($seconds < 10) {$seconds_str = "0".number_format(($seconds + $decimal), 3, '.', '');}
			else {$seconds_str = number_format(($seconds + $decimal), 3, '.', '');}
			// 				else {$seconds_str = ($seconds + $decimal);}
		
			// 			$time    = "$hours:$minutes:$seconds.".number_format($decimal, 3, '.', '');
			//REF http://www.php.net/manual/en/function.number-format.php
			// 			$time    = "$hours_str:$minutes_str";
				
			if ($hours == "00") {
					
				$time    = "$minutes_str:$seconds_str";
		
			} else {
					
				$time    = "$hours_str:$minutes_str:$seconds_str";
					
			}
			;
		
			// 			$time    = "$hours_str:$minutes_str:$seconds_str";
			// 			$time    = "$hours:$minutes:"
			// 						.number_format(($seconds + $decimal), 3, '.', '');
			// 			$time    = "$integer.$decimal";
				
			return $time;
				
		}//conv_Float_to_TimeLabel ($float_time)

		public static function 
		startsWith
		($haystack, $needle) {
			$length = strlen($needle);
			return (substr($haystack, 0, $length) === $needle);
		}
		
		public static function 
		endsWith
		($haystack, $needle) {
			$length = strlen($needle);
			if ($length == 0) {
				return true;
			}
		
			return (substr($haystack, -$length) === $needle);
		}

		/**********************************
		* csv_to_array
		* 
		* Steps for handling multibyte chars in a csv file
		* 	1. setlocale()	=> that's it
		* 		=> syntax is ---> setlocale(LC_ALL, 'ja_JP.UTF-8');
		* 		=> notice: encoding string needed after the locale place string
		* 			---> i.e. "UTF-8" after "ja_JP", preceeded by a dot "."
		**********************************/
		//REF http://php.net/manual/ja/function.str-getcsv.php
		public static function
		csv_to_array
		($filename='', $delimiter=',') {
			
// 			//test
// 			Utils::write_Log(
// 					Utils::get_dPath_Log(),
// 					//REF http://www.phpbook.jp/func/string/index7.html
// 					"mb_internal_encoding => ".mb_internal_encoding(),
// 					__FILE__, __LINE__);
					
			
			//test
// 			setlocale(LC_ALL, 'ja-JP');
			setlocale(LC_ALL, 'ja_JP.UTF-8');
			
			/**********************************
			* validate
			**********************************/
			if(!file_exists($filename) || !is_readable($filename))
				return FALSE;
		
			// 		$header = NULL;
			$data = array();
		
			if (($handle = fopen($filename, 'r')) !== FALSE) {
					
				while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
		
					// 				if(!$header)
						// 					$header = $row;
						// 				else
							// 					$data[] = array_combine($header, $row);
						array_push($data, $row);
		
				}
					
				fclose($handle);
					
			}
		
			return $data;
		
		}//csv_to_array

		public static function
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
		
		public static function
		_get_Selector_Category_From_GenreID($id) {
		
			//REF http://stackoverflow.com/questions/2802677/what-are-the-possible-reasons-for-appimport-not-working answered May 10 '10 at 13:18
			$model = ClassRegistry::init('Category');
			
// 			$option = array('order' => array('Category.name' => 'asc'));
				
// 			$this->loadModel('Category');
		
			if ($id != null) {
					
				$option = array(
							
						'order' => array('Category.name' => 'asc'),
						'conditions'	=> array('Category.genre_id' => $id)
							
				);
					
			} else {
					
				$option = array('order' => array('Category.name' => 'asc'));
					
			}
		
		
			$categories = $model->find('all', $option);
// 			$categories = $this->Category->find('all', $option);
		
			$select_Categories = array();
		
			foreach ($categories as $category) {
		
				$category_Name = $category['Category']['name'];
				$category_Id = $category['Category']['id'];
		
				$select_Categories[$category_Id] = $category_Name;
		
			}
		
			return $select_Categories;
		
		}//_get_Selector_Category
		
		public static function
		_get_Selector_Genre() {
		
// 			$this->loadModel('Genre');
// 			App::import("Genre");
		
// 			$model = new Genre();
	
			//REF http://stackoverflow.com/questions/2802677/what-are-the-possible-reasons-for-appimport-not-working answered May 10 '10 at 13:18
			$model = ClassRegistry::init('Genre');
						
			$option = array('order' => array('Genre.name' => 'asc'));
			
			$genres = $model->find('all', $option);
			
		
// 			$genres = $this->Genre->find('all', $option);
			// 		$genres = $this->Genre->find('all');
		
			$select_Genres = array();
		
			foreach ($genres as $genre) {
		
				$genre_Name = $genre['Genre']['name'];
				$genre_Id = $genre['Genre']['id'];
		
				$select_Genres[$genre_Id] = $genre_Name;
		
			}
		
			return $select_Genres;
		
		}//_get_Selector_Genre

		public static function
		isKanji_All
		($str) {
			
			foreach ($str as $chr) {
			
				if (!preg_match("/^[一-龠]+$/u",$chr)) {
					
					return false;
					
				};
			
			}
			
			return true;
			
		}//isKanji_All
		
		/**********************************
		* @return
		* 	1	=> Kanji<br>
		* 	2	=> Hiragana<br>
		* 	3	=> Katakana<br>
		* 	4	=> Number<br>
		**********************************/
		public static function
		get_Type
		($str) {
			
			$flag = true;
			
			/**********************************
			* kanji
			**********************************/
			//REF http://stackoverflow.com/questions/2556289/php-split-multibyte-string-word-into-separate-characters answered Mar 31 '10 at 21:56
			foreach (preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY) as $chr) {
// 			foreach ($str as $chr) {
			
// 				debug($chr);
				
				if (!preg_match("/^[一-龠]+$/u",$chr)) {
					
					$flag = false;
					
// 					debug("not match, kanji");
					
					break;
					
				} else {
					
// 					debug("mactch, kanji");
					
				}
			
			}
			
			if ($flag == true) {
				
// 				debug("all match, kanji");
				
				return 1;
				
			}
			
			/**********************************
			* hiragana
			**********************************/
			$flag = true;
			
			foreach (preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY) as $chr) {
// 			foreach ($str as $chr) {
			
// 				debug($chr);
				
				if (!preg_match("/^[ぁ-んー]+$/u",$chr)) {
					
// 					debug("not match, hira");
					
					$flag = false;
					
					break;
					
				} else {
					
// 					debug("match, hira");
					
				}
			
			}
			
			if ($flag == true) {
				
// 				debug("all match, hira");
				
				return 2;
				
			}
			
			/**********************************
			* katakana
			**********************************/
			$flag = true;
			
			foreach (preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY) as $chr) {
// 			foreach ($str as $chr) {
			
// 				debug($chr);
				
				if (!preg_match("/^[ァ-ヶー]+$/u",$chr)) {
					
// 					debug("not match, hira");
					
					$flag = false;
					
					break;
					
				} else {
					
// 					debug("match, hira");
					
				}
			
			}
			
			if ($flag == true) {
				
// 				debug("all match, hira");
				
				return 3;
				
			}
			
			/**********************************
			* number
			**********************************/
			$flag = true;
			
			foreach (preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY) as $chr) {
// 			foreach ($str as $chr) {
			
// 				debug($chr);
				
				if (!preg_match("/^[0-9０-９]+$/u",$chr)) {
					
// 					debug("not match, hira");
					
					$flag = false;
					
					break;
					
				} else {
					
// 					debug("match, hira");
					
				}
			
			}
			
			if ($flag == true) {
				
// 				debug("all match, hira");
				
				return 4;
				
			}
			
			return 0;
			
// 			return true;
			
		}//isKanji_All
		
	}//class Utils
	