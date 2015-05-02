<?php

	require_once 'CONS.php';
	require_once 'models/Histo.php';
	require_once 'models/Category.php';
	require_once 'models/Genre.php';
	
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
				
// 			write_Log(
// 			CONS::get_dPath_Log(),
// 			// 				$this->get_dPath_Log(),
// 			$msg,
// 			__FILE__,
// 			__LINE__);
				
				
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

		/**********************************
		* from: test_Texts.php: test_ArraySlice($sen, $numOf_SubSentences, $split_Char)
		**********************************/
		public static function
		breakdown_Sentence
		($sen, $numOf_SubSentences, $split_Char) {

			/**********************************
			* prep: data
			**********************************/
			$ary = mb_split($split_Char, $sen);
		
			$numOf_Tokens = count($ary);
		
			/**********************************
			 * slice
			**********************************/
			$numOf_Lots = $numOf_SubSentences;
		
			$numOf_Tokens_perLot = intval(ceil($numOf_Tokens / $numOf_Lots));
		
			$ary_SlicedArrays = array($numOf_Lots);
		
			for ($i = 0; $i < $numOf_Lots; $i++) {
		
				$ary_SlicedArrays[$i] = array_slice(
						$ary,
						$numOf_Tokens_perLot * $i,
						$numOf_Tokens_perLot);
		
			}
		
			/**********************************
			* return
			**********************************/
			return $ary_SlicedArrays;
			
		}//breakdown_Sentence

		/**********************************
		* REF http://www.kinghost.com.br/php/ref.simplexml.php 09-Dec-2011 08:31
		* 
		* parameters of the original => &$base, $add
		* changed to				=> $base, $add
		**********************************/
		public static function
		mergeXML($base, $add) {
// 		mergeXML(&$base, $add) {
			$new = $base->addChild($add->getName());
			foreach ($add->attributes() as $a => $b) {
				$new[$a] = $b;
			}
			foreach ($add->children() as $child) {
				
				Utils::mergeXML($new, $child);
// 				$this->mergeXML($new, $child);
			}
			
			/**********************************
			* return => this code is not in the REF code
			**********************************/
			return $base;
			
		}
		
		public static function
// 		mergeXML_2(&$base, $add) {
		mergeXML_2($base, $add) {
			
			$new = $base->addChild($add->getName());

			$new->surface = $add->surface;
			$new->feature = $add->feature;
			
// 			/**********************************
// 			* return => this code is not in the REF code
// 			**********************************/
			return $base;
			
		}//mergeXML_2

		/**********************************
		 * @return
		*
		* 	=> array(words)
		*
		*	Copied from => HistorysController._view_Mecab($history)
		**********************************/
		public static function
		get_Mecab_WordsArray($text) {
		
			/**********************************
				* prep: sentences
			**********************************/
			$sen = $text;
// 			$sen = $this->sanitize($history['History']['content']);
		
			/**********************************
				* experi
			**********************************/
			$max = 800;
		
			if (mb_strlen($sen) > $max) {
					
				$words_ary = Utils::get_Mecab_WordsArray__MultiLots($sen, $max);
// 				$words_ary = $this->_view_Mecab__MultiLots($sen, $max);
					
			} else {
		
				$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
		
				//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
				$xml = simplexml_load_file($url);
		
				$words_ary = array($xml->word);
				// 			$words = $xml->word;
					
			}
		
			return $words_ary;
		
		}//get_Mecab_WordsArray
		
		public static function
		get_Mecab_WordsArray__MultiLots($sen, $max) {
		
// 			debug("mb_strlen(\$sen) > $max");
				
// 			debug("needs => ".intval(ceil(mb_strlen($sen) / $max))." lots");
		
		
			/**********************************
				* split: original sentence
			**********************************/
			$sen_Array = mb_split("。", $sen);
		
// 			debug("sen_Array => ".count($sen_Array));
		
			$numOf_SentenceArray = count($sen_Array);
		
			/**********************************
				* prep: sentences derived from the original
			**********************************/
			$numOf_Lots = intval(ceil(mb_strlen($sen) / $max));
		
// 			debug("numOf_Lots => $numOf_Lots");
		
			$numOf_Senteces_perLot = intval(ceil($numOf_SentenceArray / $numOf_Lots));
		
// 			debug("numOf_Senteces_perLot => $numOf_Senteces_perLot");
		
			/**********************************
				* split: original sentence => again
			**********************************/
			$split_Char = "。";
		
			$ary_SlicedArrays = Utils::breakdown_Sentence($sen, $numOf_Lots, $split_Char);
		
			$numOf_SlicedArrays = count($ary_SlicedArrays);
		
// 			debug("ary_SlicedArrays => ".$numOf_SlicedArrays);
			// 		debug("ary_SlicedArrays => ".count($ary_SlicedArrays));
		
			// get xmls
			$xmls = array($numOf_SlicedArrays);
		
			for ($i = 0; $i < $numOf_SlicedArrays; $i++) {
					
				$text = implode($split_Char, $ary_SlicedArrays[$i]);
					
				$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$text";
					
				$xmls[$i] = simplexml_load_file($url);
					
			}
		
			/**********************************
				* shorten sentence
			**********************************/
			$sen = mb_substr($sen, 0, $max);
		
			$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
		
			//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
			$xml = simplexml_load_file($url);
		
			if ($xmls == null) {
		
				return array($xml->word);
					
			} else {
		
				$num = count($xmls);
					
				$words_ary = array();
				// 			$words_ary = array($num);
					
				for ($i = 0; $i < $num; $i++) {
		
					array_push($words_ary, $xmls[$i]);
		
				}
					
				return $words_ary;
					
			}
		
		}//get_Mecab_WordsArray__MultiLots

		public static function
		get_Words($text) {
		
			$sen = Utils::_sanitize($text);
// 			$sen = $this->_sanitize($text);
		
// 			debug("\$sen is...");
// 			debug($sen);
			
			$max = 800;
			// 		$max = 1500;	//=> error
			// 		$max = 2000;	//=> error
			
			if (mb_strlen($sen) > $max) {
					
				$words_ary = Utils::get_Mecab_WordsArray__MultiLots($sen, $max);
// 				$words_ary = $this->_view_Mecab__MultiLots($sen, $max);
				// 			$words = $this->_view_Mecab__MultiLots($sen, $max);
					
			} else {
			
				$url = "http://yapi.ta2o.net/apis/mecapi.cgi?sentence=$sen";
			
				//REF http://stackoverflow.com/questions/12542469/how-to-read-xml-file-from-url-using-php answered Sep 22 '12 at 9:17
				$xml = simplexml_load_file($url);
			
				$words_ary = array($xml->word);
				// 			$words = $xml->word;
					
			}
			
			return $words_ary;
				
		}//_view_Mecab

		public static function
		_sanitize
		($str, $tag="font") {
		
			$tag = "font";
			$p = "/<$tag.+?>(.+)<\/$tag>/";
		
			$rep = '${1}';
		
			return preg_replace($p, $rep, $str);
		
		}

		public static function
		get_BS_Subject($token_Sen, &$id) {
			
			$ary_Ha = array();
			
			for ($i = 0; $i < count($token_Sen); $i++) {
					
				$token_Combo = array();
					
// 				debug("\$token_Sen[".$i."] is...");
// 				debug($token_Sen[$i]);
				
				if ($token_Sen[$i]['Token']['form'] == 'は'
						&& $token_Sen[$i]['Token']['hin'] == '助詞'
// 						&& $token_Sen[$i]['Token']['history_id'] == '82'
						// 					&& $tokens[$i]['Token']['insentence_id'] == $i
				) {
			
					debug("yes => ");
					array_push($token_Combo, $token_Sen[$i]);
					array_push($token_Combo, $i);
			
					array_push($ary_Ha, $token_Combo);
					// 				array_push($text_Ha_ary, $token_Sen[$i]);
			
				}
				
			}

			/**********************************
			* validate
			**********************************/
			if (count($ary_Ha) < 1) {
				
				debug("\$ary_Ha => no entry");
				
				return null;
				
			}
			
			/**********************************
			* build: word
			**********************************/
			
			$bs_Subject = Utils::get_Word_Ha($token_Sen, $ary_Ha[0]);
			
			$id = $ary_Ha[0][1];
			
			return $bs_Subject;
			
// 			debug("count(\$ary_Ha) is ...");
// 			debug(count($ary_Ha));
// 			debug($ary_Ha[0]);
// 			debug($token_Combo);
			
		}//get_BS_Subject

		public static function
		get_BS_Verb($token_Sen, $start_Id) {
			
			$ary_Verb = array();
			
			for ($i = $start_Id; $i < count($token_Sen); $i++) {
// 			for ($i = 0; $i < count($token_Sen); $i++) {
					
				$token_Combo = array();
				
				if (
// 						$token_Sen[$i]['Token']['form'] == 'は'
// 						&& $token_Sen[$i]['Token']['hin'] == '助詞'
						$token_Sen[$i]['Token']['hin'] == '動詞'
// 						&& $token_Sen[$i]['Token']['history_id'] == '82'
						// 					&& $tokens[$i]['Token']['insentence_id'] == $i
				) {
			
					debug("yes => ");
					array_push($token_Combo, $token_Sen[$i]);
					array_push($token_Combo, $i);
			
					array_push($ary_Verb, $token_Combo);
					// 				array_push($text_Ha_ary, $token_Sen[$i]);
			
				}
				
			}

			/**********************************
			* validate
			**********************************/
			if (count($ary_Verb) < 1) {
				
				debug("\$ary_Verb => no entry");
				
				return null;
				
			}
			
			/**********************************
			* build: word
			**********************************/
			$bs_Verb = Utils::get_Word_Verb($token_Sen, $ary_Verb[0]);
			
			return $bs_Verb;
			
		}//get_BS_Verb

		
		public static function
		sanitize_Tags($article_line, $tag_array) {
			
			for ($i = 0; $i < count($tag_array); $i++) {
				
				$tag = $tag_array[$i];
				
				$pattern = "/<$tag.*?>/";
// 				$pattern = "/<$tag.+>/";
// 				$pattern = "<$tag.+>";
				$replacement = "";
				
				$article_line = preg_replace($pattern, $replacement, $article_line);
// 				preg_replace($pattern, $replacement, $article_line);
				
				$pattern = "/<\/$tag>/";
// 				$pattern = "/<$tag.+>/";
// 				$pattern = "<$tag.+>";
				$replacement = "";
				
				$article_line = preg_replace($pattern, $replacement, $article_line);
// 				preg_replace($pattern, $replacement, $article_line);
				
			}
			
			return $article_line;
			
		}//sanitize_Tags

		public static function
		unset_Vars($target, $var_Array) {
			
			$count = 0;
			
			foreach ($var_Array as $v) {
				
				unset($target[$v]);
// 				unset($v);
				
				$count ++;
				
			}
			
			return $target;
// 			return $count;
			
		}//unset_Vars

		public static function
		find_Tokens_from_CatId($cat_id) {
			
			/*******************************
				model
			*******************************/
			$model = ClassRegistry::init('Token');
			
			/*******************************
			 get: tokens
			*******************************/
			$option = array('conditions' =>
			
// 					array("AND" =>
							array("Token.category_id" => $cat_id),
// 							array('Token.hin' => "名詞")
// 					),
			);//array('conditions'
			
			$tokens = $model->find('all', $option);

			return $tokens;
			
		}//find_Tokens_from_CatId_and_Hin

		public static function
		find_Genre_from_Code($code) {
			
			/*******************************
				model
			*******************************/
			$model = ClassRegistry::init('Genre');
			
			/*******************************
			 get: tokens
			*******************************/
			$option = array('conditions' =>
			
// 					array("AND" =>
							array("Genre.code" => $code),
// 							array('Token.hin' => "名詞")
// 					),
			);//array('conditions'
			
			$genre = $model->find('first', $option);

			return $genre;
			
		}//find_Genre_from_Code($code)

		/*******************************
			@return
			$histo, $total
		*******************************/
		
		public static function
		get_Histo($tokens_1) {
			
			/*******************************
			 build: list
			*******************************/
			$s = "";
			
			$nouns = array();
			
			for ($i = 0; $i < count($tokens_1); $i++) {
					
				$t = $tokens_1[$i];
					
				if ($t['Token']['hin'] == "名詞") {
			
					$s .= $t['Token']['form'];
			
					continue;
			
				} else {
			
					if ($s == "") {
			
						continue;
			
					} else {
			
						// 					if ($s != null) {	//=> w
						// 					if ($s != null && $s != "") {	//=> w
						if ($s != null && $s != "" && $s != -1) {	//=> w
							// 					if ($s != null && $s != "" && $s != -1 && $s != 0) {	//=> debug displayed
							// 					if ($s != null && $s != "" && $s != -1 && $s != 0) {
							// 					if ($s != "０" && $s != "0") {
							// 					if ($s != "０") {
			
							// 						debug($s);
			
							array_push($nouns, $s);;
			
						} else {
			
//							debug($s);
			
						}
							
						// 					array_push($nouns, $s);
							
						$s = "";
							
						continue;
			
					}
			
				}//if ($t['Tokens']['hin'] == "名詞")
					
			}//for ($i = 0; $i < count($tokens_1); $i++)
			
			$nouns_unique = array_unique($nouns);
			
// 			debug("count(\$nouns_unique)");
// 			debug(count($nouns_unique));
			
				// 		// omit '0'
				// 		$len = count($nouns_unique);
			
			// // 		debug($nouns_unique[10]);
			
			// // 		debug(array_slice($nouns_unique, 600, 10));
			// // 		debug($len);
			
			// 		for ($i = 0; $i < $len; $i++) {
			// // 		for ($i = 0; $i < count($nouns_unique); $i++) {
				
			// 			debug($nouns_unique[$i]."(".$i.")");
				
			// // 			$noun = $nouns_unique[$i];
			// // 			$n = $nouns_unique[$i];
				
			// // 			if ($n == "0") {
			// // // 			if ($n == '0') {
			
			// // 				debug("yes");
			// // // 				debug("='0'");
			
			// // 			}
			// 		}
			
			
			// // 		$nouns_unique = array_diff($nouns_unique, array('0'));
			
			
//			debug("count(\$nouns_unique)");
//			debug(count($nouns_unique));
			
			$len_unique = count($nouns_unique);
			
			$nouns_unique = array_values($nouns_unique);
			
// 			// 		// omit '0'
// 			// 		unset($nouns_unique[0]);
			
// 			// 		debug("unset => \$nouns_unique[0]");
			
// 			// 		debug(array_slice($nouns_unique, 0, 20));
			
// 			for ($i = 0; $i < $len_unique; $i++) {
// 				// 		for ($i = 0; $i < count($nouns_unique); $i++) {
			
// 				$n = $nouns_unique[$i];
					
// 				if ($n == '0') {
			
// //					debug("='0'");
			
// 				} else if ($n == "0") {
			
// //					debug("=\"0\"");
			
// 				} else if ($n == "０") {
			
// //					debug("=\"０\"");
			
// 				}
					
					
// 				// 			debug($nouns_unique[$i]."(".$i.")");
			
// 				// 			$noun = $nouns_unique[$i];
// 				// 			$n = $nouns_unique[$i];
			
// 				// 			if ($n == "0") {
// 				// // 			if ($n == '0') {
			
// 				// 				debug("yes");
// 				// // 				debug("='0'");
			
// 				// 			}
// 			}
			
// 			// 		$nouns_unique = array_diff($nouns_unique, array("０"));
			
// 			// 		$len_unique = count($nouns_unique);
			
// 			// 		$nouns_unique = array_values($nouns_unique);
			
			/*******************************
			 histogram
			*******************************/
			$histo = array($len_unique);
			
			for ($i = 0; $i < $len_unique; $i++) {
					
				$histo[$nouns_unique[$i]] = 0;
					
			}
			
			$len_total = count($nouns);
			
			for ($i = 0; $i < $len_total; $i++) {
					
				$histo[$nouns[$i]] ++;
					
			}
			
			// 		debug(array_slice($histo, 0, 10));
			
			/*******************************
			 sort
			*******************************/
			asort($histo);
			
			$histo = array_reverse($histo);
			
			// omit '0'
			$omit = array(0);
// 			$omit = array(0, 'こと', '人', 'ロボット', '理由', '場合', '中止', 'ため', 'の');
			
			$histo = Utils::unset_Vars($histo, $omit);
// 			// 		$histo = Utils::unset_Vars($histo, array(0, 'こと', '人', 'ロボット'));
// 			// 		$histo = Utils::unset_Vars($histo, array(0, 'こと'));	//=> w
// 			// 		$histo = Utils::unset_Vars($histo, array(0));	//=> w
// 			// 		Utils::unset_Vars($histo, array(0));
// 			// 		Utils::unset_Vars(array($histo[0], $histo['こと']));
// 			// 		unset($histo[0]);
			
// 			// 		debug($histo);
			
			/*******************************
			 set: values
			*******************************/
			$total = 0;
			
			// 		debug(array_slice($histo, 10,10));
			
			// 		$total += $histo[0] + $histo[1];
			
			// 		debug($total);
			
			// 		debug($histo[0]);
			// 		debug($histo[1]);
			
			$count = 0;
			
			foreach ($histo as $h) {
					
				$total += $h;
					
				// 			debug($h."/".$total);
					
				// 			$count ++;
					
				// 			if ($count > 10) {
			
				// 				break;;
			
				// 			}
					
			}
			
			// 		debug($total);
			
			// 		for ($i = 0; $i < count($histo); $i++) {
				
			// 			$total += $histo[$i];
				
			// 		}
			
// 			$this->set("total", $total);
// 			// 		$this->set("total", count($nouns));
// 			// 		$this->set("total", count($tokens));
			
// 			$this->set("histo", $histo);

			return array($histo, $total);
			
// 			return array();
			
		}//get_Histo

		public static function
		get_Admin_Value
		($key, $val_1) {
		
// 			$this->loadModel('Admin');
	
			//REF http://stackoverflow.com/questions/2802677/what-are-the-possible-reasons-for-appimport-not-working answered May 10 '10 at 13:18
			$model = ClassRegistry::init('Admin');
		
			$option = array(
						
					'conditions'	=> array(
							'Admin.name LIKE'	=> $key
					)
			);
		
			// 		$admin = $this->Admin->find('first');
			$admin = $model->find('first', $option);
// 			$admin = $this->Admin->find('first', $option);
		
			// 		debug($admin);
		
			if ($admin == null) {
			
				return null;
			
			} else {
			
				return @$admin['Admin'][$val_1];
				
			}//if ($admin == null)
			
			
			
// 			return @$admin['Admin'][$val_1];
		
		}//get_Admin_Value


		public static function
		get_Matching_Scores($keys_Target, $keys_Ref) {
			
			$score_1 = 0;
			
			for ($i = 0; $i < $len; $i++) {
			
				for ($j = 0; $j < $len; $j ++) {
					// 			foreach ($keys_Ref as $data) {
					// 			foreach ($data_1[0] as $data) {
			
					$data = $keys_Ref[$j];
						
					if ($keys_Target[$i] == $data) {
			
						$score_1 ++;
			
						// 					debug("match => ".$keys_Target[$i]." / ".$data);
			
					}
				}
			
			}

			return $score_1;
			
		}//get_Matching_Scores

		/*******************************
			if $target is not found in the array $tokens,<br>
				=> returns -1
		*******************************/
		public static function
		get_Index($tokens, $target) {
			
			$index = -1;
			
			$len = count($tokens);
			
			for ($i = 0; $i < $len; $i++) {
				
				$t = $tokens[$i];
				
				if ($t == $target) {
					
					return $i;
					
				}
				
			}
			
			return $index;
			
		}//get_Index($tokens, $start_Dir)
		
		
		/*******************************
			if $start_Dir is not found in $dpath<br>
				=> returns $dpath
		*******************************/
		public static function
		get_Dirname($dpath, $start_Dir) {
			
// 			printf("[%s : %d] dirname=%s", __FILE__, __LINE__, dirname($dpath));
			
			//REF SEPARATOR http://stackoverflow.com/questions/6654157/how-to-get-a-platform-independent-directory-separator-in-php answered Jul 11 '11 at 17:47
			$tokens = explode(DIRECTORY_SEPARATOR, $dpath);
			
			$loc = Utils::get_Index($tokens, $start_Dir);

			if ($loc == -1) {
				
				return $dpath;
				
			}
			
			return implode(DIRECTORY_SEPARATOR, array_slice($tokens, $loc, count($tokens)));
			
// 			return dirname($dpath)."***".basename($dpath);
			
		}//get_Dirname($dpath, $start_Dir)

		/*******************************
			convert: rows of csv data to tokens<br>
			@param
			$rows => (csv1, csv2, ...)
		*******************************/
		public static function
		conv_Rows_2_Tokens($smarty, $rows) {

			$tokens = array();
			
			$len = count($rows);

			for ($i = 0; $i < $len; $i++) {
				
				$r = $rows[$i];
				
				$token = new Token();
				
				$token->set_created_at($r[1])
						->set_updated_at($r[2])
						->set_form($r[3])
						->set_hin($r[4])
						
						->set_hin_1($r[5])
						->set_hin_2($r[6])
						->set_hin_3($r[7])
						
						->set_katsu_kei($r[8])
						->set_katsu_kata($r[9])
						->set_genkei($r[10])
							
						->set_yomi($r[11])
						->set_hatsu($r[12])
							
						->set_history_id($r[13])
						->set_category_id($r[14])
						->set_genre_id($r[15])
							
						->set_user_id($r[16])
						
						->set_orig_id($r[0])
						
						->set_db_Id($r[0])
				;
				
				array_push($tokens, $token);
				
			}
			
// 			printf("[%s : %d] tokens => %d", 
// 					Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
// 					__LINE__, count($tokens));

// 			echo "<br>"; echo "<br>";
			
			/*******************************
				return
			*******************************/
			return $tokens;
			
		}//conv_Rows_2_Tokens
		
		
		/*******************************
			convert: a row of csv data to a token<br>
			@param
			$row => ([0] => id, [1] => created_at, ...)
		*******************************/
		public static function
		conv_Row_2_Token($smarty, $row) {

// 			$token = null;

// 			echo "<br>"; echo "<br>";
			
// 			printf("[%s : %d] \$row", 
// 							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
			
// 			echo "<br>"; echo "<br>";
			
// 			var_dump($row);
			
			$token = new Token();

			$token->set_created_at($row[1])
					->set_updated_at($row[2])
					->set_form($row[3])
					->set_hin($row[4])
					
					->set_hin_1($row[5])
					->set_hin_2($row[6])
					->set_hin_3($row[7])
					
					->set_katsu_kei($row[8])
					->set_katsu_kata($row[9])
					->set_genkei($row[10])
					
					->set_yomi($row[11])
					->set_hatsu($row[12])
					
					->set_history_id($row[13])
					->set_category_id($row[14])
					->set_genre_id($row[15])
					
					->set_user_id($row[16])
					
					->set_orig_id($row[0])
			;
				
// 			$token->set_created_at($row[1])
// 					->set_updated_at($row[2])
// 					->set_form($row[3])
// 					->set_hin($row[4])
// 					->set_db_Id($row[0])
// 			;
			
			/*******************************
				return
			*******************************/
			return $token;
			
		}//conv_Rows_2_Tokens

		/*******************************
			convert: a row of csv data to a token<br>
			@param
			$row => ([0] => id, [1] => created_at, ...)
		*******************************/
		public static function
		conv_Row_2_Category($smarty, $row) {

			$category = new Category();

			$category
					->set_original_id($row[0])
					->set_created_at($row[1])
					->set_updated_at($row[2])
					->set_name($row[3])
					
					->set_genre_id($row[4])
			;
				
			/*******************************
				return
			*******************************/
			return $category;
			
		}//conv_Row_2_Category

		/*******************************
			convert: a row of csv data to a token<br>
			@param
			$row => ([0] => id, [1] => created_at, ...)
		*******************************/
		public static function
		conv_Row_2_Genre($smarty, $row) {

			$genre = new Genre();

			$genre
					->set_original_id($row[0])
					->set_created_at($row[1])
					->set_updated_at($row[2])
					
					->set_code($row[3])
					->set_name($row[4])
					
			;
				
			/*******************************
				return
			*******************************/
			return $genre;
			
		}//conv_Row_2_Genre($smarty, $row)

		/*******************************
			convert: a row of db record to a category instance<br>
			@param
			$row => ([0] => id, [1] => created_at, ...)
		*******************************/
		public static function
// 		conv_DB_2_Category($row) {
		conv_DB_2_Category($smarty, $row) {

			$category = new Category();

			$category
					->set_db_Id($row[0])
					->set_created_at($row[1])
					->set_updated_at($row[2])
					->set_name($row[3])
					
					->set_genre_id($row[4])
					->set_original_id($row[5])
			;
				
			/*******************************
				return
			*******************************/
			return $category;
			
		}//conv_Row_2_Category

		/*******************************
			convert: a row of db record to a genre instance<br>
			@param
			$row => ([0] => id, [1] => created_at, ...)
		*******************************/
		public static function
		conv_DB_2_Genre($smarty, $row) {

			$genre = new Genre();

			$genre
					->set_db_Id($row[0])
					->set_created_at($row[1])
					->set_updated_at($row[2])
					
					->set_code($row[3])
					->set_name($row[4])
					
					->set_original_id($row[5])
			;
				
			/*******************************
				return
			*******************************/
			return $genre;
			
		}//conv_Row_2_Genre

		public static function
		divide_CSV($smarty) {
			
			$numOf_Lines_PerFile = CONS::$numOf_Lines_PerFile;
			
			/*******************************
			 open
			*******************************/
			$fname = "../data/tokens.csv";
			
			$f = fopen($fname, "r");
			
			if ($f == false) {
					
				printf("[%s : %d] open csv => false",
				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
					
				echo "<br>";
				echo "<br>";
					
				return ;
					
			} else {
					
				printf("[%s : %d] csv => opened: %s",
				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $fname);
			
				echo "<br>"; echo "<br>";
					
			}
				
			/*******************************
				get: header
			*******************************/
			$header = fgets($f);
			
			$line = fgets($f);		// first line
			
// 			printf("[%s : %d] header => %s", 
// 							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $header);

			/*******************************
				read, write
			*******************************/
			$id = 1;
			
			$fname = sprintf("../data/tokens_%02d.csv", $id);
// 			$fname = "../data/tokens_$id.csv";
				
			$fout = fopen($fname, "w");
			
			fwrite($fout, $header);
			
			$count = 0;
			
			$total = 0;
			
			//REF fgets http://www.tizag.com/phpT/fileread.php
			while ($line) {

				if ($count >= $numOf_Lines_PerFile) {
					
					fclose($fout);
					
					$id ++;
					
// 					$fname = "../data/tokens_$id.csv";
					$fname = sprintf("../data/tokens_%02d.csv", $id);
					
					$fout = fopen($fname, "w");

					printf("[%s : %d] new file opened => %s", 
									Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
									__LINE__, $fname);
					
					fwrite($fout, $header);
					
					$count = 0;
					
// 					break;
					
				}
				
				fwrite($fout, $line);
				
				$count ++;
				
				$total ++;
				
// 				if ($total > 30000) {
					
// 					break;;
					
// 				}
				
				$line = fgets($f);
					
			}//while (condition)
			
			/*******************************
			 close
			*******************************/
			fclose($f);
			
			fclose($fout);
			
			printf("[%s : %d] csv => closed", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
			
			echo "<br>"; echo "<br>";
			
		}//divide_CSV

		/*******************************
			@return
			null	=> can't open the file
		*******************************/
		public static function
		get_Tokens_from_CSV($smarty, $fname) {
		
			/*******************************
			 open
			*******************************/
			$f = fopen($fname, "r");
		
			if ($f == false) {
					
				printf("[%s : %d] csv => false",
				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
					
				echo "<br>";
				echo "<br>";
					
				return null;
					
			} else {
					
				printf("[%s : %d] csv => opened: %s",
				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $fname);
		
				echo "<br>"; echo "<br>";
					
			}
		
			/*******************************
			 read: csv
			*******************************/
			$count = 0;
			$len = -1;
		
			$data = fgetcsv($f, 500, ",");		// first line => header
			$data = fgetcsv($f, 500, ",");		//
		
			$content = "";
		
			$tokens = array();
		
			//REF fgets http://www.tizag.com/phpT/fileread.php
			while ($data) {
		
				$t = Utils::conv_Row_2_Token($smarty, $data);
					
				array_push($tokens, $t);
					
				$data = fgetcsv($f, 500, ",");
				
			}//while (condition)
		
// 			printf("[%s : %d] tokens[10]", 
// 							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
			
			
// 			echo "<br>"; echo "<br>";
			
// 			var_dump($tokens[10]);
			
			/*******************************
			close
			*******************************/
			fclose($f);

			/*******************************
				return
			*******************************/
			return $tokens;
			
		}//get_Tokens_from_CSV($smarty, $fname)

		/*******************************
			@return
			null	=> can't open the file
		*******************************/
		public static function
		get_Categories_from_CSV($smarty, $fname) {
		
			/*******************************
			 open
			*******************************/
			$f = fopen($fname, "r");
		
			if ($f == false) {
					
				printf("[%s : %d] csv => false",
				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
					
				echo "<br>";
				echo "<br>";
					
				return null;
					
			} else {
					
				printf("[%s : %d] csv => opened: %s",
				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $fname);
		
				echo "<br>"; echo "<br>";
					
			}
		
			/*******************************
			 read: csv
			*******************************/
			$count = 0;
			$len = -1;
		
			$data = fgetcsv($f, 500, ",");		// first line => header
			$data = fgetcsv($f, 500, ",");		//
		
			$content = "";
		
			$categories = array();
		
			//REF fgets http://www.tizag.com/phpT/fileread.php
			while ($data) {
		
				$t = Utils::conv_Row_2_Category($smarty, $data);
// 				$t = Utils::conv_Row_2_Token($smarty, $data);
					
				array_push($categories, $t);
					
				$data = fgetcsv($f, 500, ",");
				
			}//while (condition)
		
			/*******************************
			close
			*******************************/
			fclose($f);

			/*******************************
				return
			*******************************/
			return $categories;
			
		}//get_Categories_from_CSV

		/*******************************
			@return
			null	=> can't open the file
		*******************************/
		public static function
		get_Genres_from_CSV($smarty, $fname) {
		
			/*******************************
			 open
			*******************************/
			$f = fopen($fname, "r");
		
			if ($f == false) {
					
				printf("[%s : %d] csv => false",
				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
					
				echo "<br>";
				echo "<br>";
					
				return null;
					
			} else {
					
				printf("[%s : %d] csv => opened: %s",
				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $fname);
		
				echo "<br>"; echo "<br>";
					
			}
		
			/*******************************
			 read: csv
			*******************************/
			$count = 0;
			$len = -1;
		
			$data = fgetcsv($f, 500, ",");		// first line => header
			$data = fgetcsv($f, 500, ",");		//
		
			$content = "";
		
			$genres = array();
		
			//REF fgets http://www.tizag.com/phpT/fileread.php
			while ($data) {
		
				$t = Utils::conv_Row_2_Genre($smarty, $data);

				array_push($genres, $t);
					
				$data = fgetcsv($f, 500, ",");
				
			}//while (condition)
		
			/*******************************
			close
			*******************************/
			fclose($f);

			/*******************************
				return
			*******************************/
			return $genres;
			
		}//get_Genres_from_CSV

		public static function
		insertData_Tokens($smarty, $tokens) {
			
			
			
		}//insertData_Tokens($smarty, $tokens)
		
		public static function
		save_Tokens_from_CSV($smarty) {

			$dir_csv = "..".DIRECTORY_SEPARATOR."data";
// 			$dir_csv = "../data";
			
			$dirlist = scandir($dir_csv);
			
// 			var_dump($dirlist);
			
// 			echo "<br>"; echo "<br>";
			
			$csv_files = array();

			$p = "/^tokens\_/";
			
			foreach ($dirlist as $name) {
				
				if (preg_match($p, $name) == 1) {
					
					array_push($csv_files, $name);
					
				};
				
			}
			
// 			var_dump($csv_files);
			
// 			echo "<br>"; echo "<br>";
			
			/*******************************
				save: tokens
			*******************************/
			/*******************************
				get: tokens list
			*******************************/
			$fname = implode(DIRECTORY_SEPARATOR, array($dir_csv, $csv_files[0]));
// 			$fname = implode(DIRECTORY_SEPARATOR, array($dir_csv, $dirlist[0]));
// 			$fname = $dirlist[0];
			
			printf("[%s : %d] opening a csv... %s", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $fname);
			
			echo "<br>"; echo "<br>";
			
			$tokens = Utils::get_Tokens_from_CSV($smarty, $fname);
			
			if ($tokens != null) {
			
				printf("[%s : %d] tokens => %d (file=%s)", 
								Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
								__LINE__, count($tokens), $fname);
			
			} else {
			
				printf("[%s : %d] tokens => null", 
								Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
				
			}//if ($tokens != null)
			
			echo "<br>"; echo "<br>";

			/*******************************
				save: tokens
			*******************************/
			$res = DB::save_Tokens($smarty, $tokens);
// 			$res = Utils::insertData_Tokens($smarty, $tokens);
			
			printf("[%s : %d] save tokens => %d", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $res);
			
			echo "<br>"; echo "<br>";

// 			//test: rename
// 			$res = 1;
			
			/*******************************
				rename: file
			*******************************/
			if ($res > 0) {

				$new_name = implode(DIRECTORY_SEPARATOR, array($dir_csv, "_".$csv_files[0]));
				
				$res = rename(
							$fname, 
							$new_name);
// 							implode(DIRECTORY_SEPARATOR, array($dir_csv, "_".$csv_files[0])));
// 							implode(DIRECTORY_SEPARATOR, array($dir_csv, "*".$csv_files[0])));
				
				if ($res == true) {
				
					printf("[%s : %d] csv renamed => %s", 
									Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
									__LINE__, 
									$new_name);
// 									implode(DIRECTORY_SEPARATOR, array($dir_csv, "*".$csv_files[0])));
				
				} else {
				
					printf	("[%s : %d] rename csv => failed: %s", 
									Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $fname);
					
				}//if ($res == true)
				
				echo "<br>"; echo "<br>";
				
			}//if ($res > 0)
			
// 			if ($tokens == null) {
			
// 				printf("[%s : %d] tokens => null",
// 				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
			
// 			} else {
			
// 				printf("[%s : %d] tokens => %d",
// 				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, count($tokens));
					
// 			}//if ($tokens == null)
			
// 			echo "<br>"; echo "<br>";
			
		}//save_Tokens_from_CSV

		public static function
		save_Categories_from_CSV($smarty) {

			$dir_csv = "..".DIRECTORY_SEPARATOR."data";
			
			$dirlist = scandir($dir_csv);
			
			$csv_files = array();

			$p = "/^categorys\_/";
// 			$p = "/^tokens\_/";
			
			foreach ($dirlist as $name) {
				
				if (preg_match($p, $name) == 1) {
					
					array_push($csv_files, $name);
					
				};
				
			}
			
			var_dump($csv_files);
			
			echo "<br>"; echo "<br>";
			
			/*******************************
				save: categories
			*******************************/
			/*******************************
				get: categories list
			*******************************/
			$fname = implode(DIRECTORY_SEPARATOR, array($dir_csv, $csv_files[0]));
			
			printf("[%s : %d] opening a csv... %s", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $fname);
			
			echo "<br>"; echo "<br>";
			
			$categories = Utils::get_Categories_from_CSV($smarty, $fname);
// 			$categories = Utils::get_Tokens_from_CSV($smarty, $fname);
			
			if ($categories != null) {
			
				printf("[%s : %d] categories => %d (file=%s)", 
								Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
								__LINE__, count($categories), $fname);
			
			} else {
			
				printf("[%s : %d] categories => null", 
								Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
				
			}//if ($categories != null)
			
			echo "<br>"; echo "<br>";

			/*******************************
				save: categories
			*******************************/
			$res = DB::save_Categories($smarty, $categories);
// 			$res = Utils::insertData_Tokens($smarty, $tokens);
			
			printf("[%s : %d] save categories => %d", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $res);
			
			echo "<br>"; echo "<br>";

// 			//test: rename
// 			$res = 1;
			
			/*******************************
				rename: file
			*******************************/
			if ($res > 0) {

				$new_name = implode(DIRECTORY_SEPARATOR, array($dir_csv, "_".$csv_files[0]));
				
				$res = rename(
							$fname, 
							$new_name);
// 							implode(DIRECTORY_SEPARATOR, array($dir_csv, "_".$csv_files[0])));
// 							implode(DIRECTORY_SEPARATOR, array($dir_csv, "*".$csv_files[0])));
				
				if ($res == true) {
				
					printf("[%s : %d] csv renamed => %s", 
									Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
									__LINE__, 
									$new_name);
// 									implode(DIRECTORY_SEPARATOR, array($dir_csv, "*".$csv_files[0])));
				
				} else {
				
					printf	("[%s : %d] rename csv => failed: %s", 
									Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $fname);
					
				}//if ($res == true)
				
				echo "<br>"; echo "<br>";
				
			}//if ($res > 0)
			
		}//save_Categories_from_CSV

		public static function
		save_Genres_from_CSV($smarty) {

			$dir_csv = "..".DIRECTORY_SEPARATOR."data";
			
			$dirlist = scandir($dir_csv);
			
			$csv_files = array();

			$p = "/^genres\_/";
// 			$p = "/^tokens\_/";
			
			foreach ($dirlist as $name) {
				
				if (preg_match($p, $name) == 1) {
					
					array_push($csv_files, $name);
					
				};
				
			}
			
			var_dump($csv_files);
			
			echo "<br>"; echo "<br>";
			
			/*******************************
				save: categories
			*******************************/
			/*******************************
				get: categories list
			*******************************/
			$fname = implode(DIRECTORY_SEPARATOR, array($dir_csv, $csv_files[0]));
			
			printf("[%s : %d] opening a csv... %s", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $fname);
			
			echo "<br>"; echo "<br>";
			
			$genres = Utils::get_Genres_from_CSV($smarty, $fname);
			
			if ($genres != null) {
			
				printf("[%s : %d] genres => %d (file=%s)", 
								Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
								__LINE__, count($genres), $fname);
			
			} else {
			
				printf("[%s : %d] genres => null", 
								Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
				
			}//if ($genres != null)
			
			echo "<br>"; echo "<br>";

			/*******************************
				save: genres
			*******************************/
			$res = DB::save_Genres($smarty, $genres);
		
			printf("[%s : %d] save genres => %d", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $res);
			
			echo "<br>"; echo "<br>";

// 			//test: rename
// 			$res = 1;
			
			/*******************************
				rename: file
			*******************************/
			if ($res > 0) {

				$new_name = implode(DIRECTORY_SEPARATOR, array($dir_csv, "_".$csv_files[0]));
				
				$res = rename(
							$fname, 
							$new_name);
				
				if ($res == true) {
				
					printf("[%s : %d] csv renamed => %s", 
									Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
									__LINE__, 
									$new_name);
// 									implode(DIRECTORY_SEPARATOR, array($dir_csv, "*".$csv_files[0])));
				
				} else {
				
					printf	("[%s : %d] rename csv => failed: %s", 
									Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $fname);
					
				}//if ($res == true)
				
				echo "<br>"; echo "<br>";
				
			}//if ($res > 0)
			
		}//save_Genres_from_CSV

		public static function
		get_ServerName() {
			
			@$server_Name = $_SERVER['SERVER_NAME'];
// 			@$server_Name = $_SERVER['SERVER_NAME'];
			
			return $server_Name;
			
// 			if ($server_Name == null) {
			
// 			} else if ($server_Name != 'localhost') {
			
					
// 			}
			
		}//get_ServerName

		public static function 
		comp_Histogram($h1, $h2) {
			
			return $h1['histo'] < $h2['histo'] ?  1 : -1; 
			
		}
		
		public static function
		get_Histogram($tokens) {
			
			/*******************************
				setup
			*******************************/
			$histo = array();
			
			$histo_2 = array();

			$nouns = array();
			
			////////////////////////////////
			// nouns list
			////////////////////////////////
			$s = "";
			
// 			$hin = array();
			$hin = "";
			$hin_1 = "";
			$hin_2 = "";
			$hin_3 = "";
			
			$db_id = "";
			
			$nouns_2 = array();		// array of Histo
			
			for ($i = 0; $i < count($tokens); $i++) {
					
				$t = $tokens[$i];
					
				if ($t->get_hin() == "名詞") {
// 				if ($t['Token']['hin'] == "名詞") {
			
					$s .= $t->get_form();
// 					$s .= $t['Token']['form'];
			
// 					array_push($hin, $t->get_hin());
// 					$hin = $t->get_hin();		//=> w
					$hin .= $t->get_hin()."/";
					$hin_1 .= $t->get_hin_1()."/";
					$hin_2 .= $t->get_hin_2()."/";
					$hin_3 .= $t->get_hin_3()."/";
					
					$db_id .= $t->get_db_id()."/";
					
					continue;
			
				} else {
			
					if ($s == "") {
			
						continue;
			
					} else {
			
						if ($s != null && $s != "" && $s != -1) {	//=> w
			
							$tmp = new Histo();
							
							$tmp->set_db_id($db_id);
							
							$tmp->set_form($s);
							$tmp->set_hin($hin);
							$tmp->set_hin_1($hin_1);
							$tmp->set_hin_2($hin_2);
							$tmp->set_hin_3($hin_3);
							
// 							$tmp->set_db_id($db_id);
							
							array_push($nouns_2, $tmp);
// 							array_push($nouns_2, $s);;
			
						} else {
			
							debug($s);
			
						}
							
						$s = "";

						$hin = "";
						$hin_1 = "";
						$hin_2 = "";
						$hin_3 = "";
						
						$db_id = "";
						
						continue;
			
					}//if ($s == "")
			
				}//if ($t['Tokens']['hin'] == "名詞")
					
			}//for ($i = 0; $i < count($tokens); $i++)

			/*******************************
				nouns list => skim
			*******************************/
			$nouns_skimmed_2 = array();		// array of Histo instances
			
			for ($i = 0; $i < count($nouns_2); $i++) {
				
				$n = $nouns_2[$i];
				
				if (!in_array($n, $nouns_skimmed_2)) {
					
					array_push($nouns_skimmed_2, $n);
					
				}
				
			}
			
			printf("[%s : %d] nouns skimmed_2 => %d", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
							__LINE__, count($nouns_skimmed_2));
			
			echo "<br>"; echo "<br>";
			
			/*******************************
				build: histogram
			*******************************/
			/*******************************
				init: skimmed list
			*******************************/
			for ($i = 0; $i < count($nouns_skimmed_2); $i++) {
				
				$s = $nouns_skimmed_2[$i];
				
// 				$histo_2[$s] = 0;		//=> Illegal offset type
				$histo_2[$s->get_form()] = array(
									"form" => null, 
									"hin" => null, 
									"hin_1" => null, 
									"hin_2" => null, 
									"hin_3" => null, 
									"histo" => 0,
						
									"db_id" => null
				);
// 				$histo_2[$s->get_form()] = array("hin_1" => null, "histo" => 0);
				
			}

			for ($i = 0; $i < count($nouns_2); $i++) {
				
				$n = $nouns_2[$i];
				
				for ($j = 0; $j < count($nouns_skimmed_2); $j++) {
					
					$s = $nouns_skimmed_2[$j];
					
					if ($s->get_form() == $n->get_form()) {

						if ($histo_2[$s->get_form()]['db_id'] == null) {
								
							$histo_2[$s->get_form()]['db_id'] = $s->get_db_id();
								
						}
						
						if ($histo_2[$s->get_form()]['form'] == null) {
							
							$histo_2[$s->get_form()]['form'] = $s->get_form();
							
						}
						
						if ($histo_2[$s->get_form()]['hin'] == null) {
							
							$histo_2[$s->get_form()]['hin'] = $s->get_hin();
							
						}
						
						if ($histo_2[$s->get_form()]['hin_1'] == null) {
							
							$histo_2[$s->get_form()]['hin_1'] = $s->get_hin_1();
							
						}
						
						if ($histo_2[$s->get_form()]['hin_2'] == null) {
							
							$histo_2[$s->get_form()]['hin_2'] = $s->get_hin_2();
							
						}
						
						if ($histo_2[$s->get_form()]['hin_3'] == null) {
							
							$histo_2[$s->get_form()]['hin_3'] = $s->get_hin_3();
							
						}
						
// 						if ($histo_2[$s->get_form()]['db_id'] == null) {
							
// 							$histo_2[$s->get_form()]['db_id'] = $s->get_db_id();
							
// 						}
						
// 						$histo_2[$s->get_form()]['db_id'] .= 
						
						$histo_2[$s->get_form()]['histo'] ++;
						
// 						$s->set_histo($s->get_histo + 1);
						
						break;
						
					}
					
				}
				
			}
			
			echo "<br>"; echo "<br>";
			
// 			printf("[%s : %d] array_slice(\$histo_2, 0,3)", 
// 							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
			
// 			echo "<br>"; echo "<br>";
			
// 			print_r(array_slice($histo_2, 0,3));
// // 			print_r($histo[$nouns_skimmed_2[0]->get_form()]);
			
// 			echo "<br>"; echo "<br>";
			
			
			/*******************************
				sort: histo
			*******************************/

// 			//REF http://stackoverflow.com/questions/6419818/php-usort-wont-sort answered Jun 21 '11 at 4:17
// 			//REF php version http://stackoverflow.com/questions/4949573/parse-error-syntax-error-unexpected-t-function-line-10-help answered Feb 9 '11 at 19:37
// 			uasort($histo, array("Utils", "comp_Histogram"));	//=> 
			
// 			printf("[%s : %d] histo => sorted", 
// 							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
			
// 			echo "<br>"; echo "<br>";
			
// 			print_r(array_slice($histo, 0,10));
// // 			print_r(array_slice($histo, 0,3));
				
// 			echo "<br>"; echo "<br>";

			////////////////////////////
			// test
			////////////////////////////
			
			//REF http://stackoverflow.com/questions/6419818/php-usort-wont-sort answered Jun 21 '11 at 4:17
			//REF php version http://stackoverflow.com/questions/4949573/parse-error-syntax-error-unexpected-t-function-line-10-help answered Feb 9 '11 at 19:37
			uasort($histo_2, array("Utils", "comp_Histogram"));	//=> 
			
// 			printf("[%s : %d] histo_2 => sorted", 
// 							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
			
// 			echo "<br>"; echo "<br>";

			$keys = array_keys($histo_2);
			
// 			for ($i = 0; $i < 10; $i++) {
				
// 				$h = $histo_2[$keys[$i]];
// // 				$h = $histo_2[$i];
				
// 				printf("[%s : %d] histo_2[%d] => ", 
// 								Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $i);
				
				
// 				echo "<br>"; echo "<br>";
				
// 				print_r($h);

// 				echo "<br>"; echo "<br>";
				
// 			}
			
// // 			print_r(array_slice($histo_2, 0,10));
// // 			print_r(array_slice($histo, 0,3));
				
// 			echo "<br>"; echo "<br>";
			
			/*******************************
				return
			*******************************/
			return $histo_2;
// 			return null;
			
		}//get_Histogram

		/*******************************
			@return
			-1	=> can't create table<br>
			1	=> table created<br>
			2	=> table exists<br>
		*******************************/
		public static function
		createTable($smarty, $tname) {
		
			/*******************************
			 get: db
			*******************************/
			$dbType = DB::get_DB_Type();
		
			$db = DB::get_DB($dbType);
		
			/*******************************
			 validate: table exists
			*******************************/
// 			$tname = DB::$tname_Categories;
				
			$res = DB::table_Exists($db, $tname);
		
			/*******************************
			 create: table
			*******************************/
			if ($res === false) {
		
				$res = DB::create_Table($db, $tname);
		
				if ($res != 0) {
						
					printf("[%s : %d] can't create table: %s",
					Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $tname);
						
					echo "<br>"; echo "<br>";
		
					$db = null;
					
					return -1;
						
				} else {
						
					printf("[%s : %d] table created: %s",
					Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $tname);
		
					echo "<br>"; echo "<br>";
		
					$db = null;
					
					return 1;
					
				}
		
			} else {
		
				printf("[%s : %d] table exists => %s",
				Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, $tname);
		
				echo "<br>"; echo "<br>";
				
				$db = null;
				
				return 2;
		
			}
		
			/*******************************
			 return
			*******************************/
// 			return ;
		
		}//createTable($smarty, $tname)

		public static function
		create_HistoFile_from_CatID($smarty, $cat_id) {
			
			/*******************************
				prep: histo
			*******************************/
			$tokens = DB::findAll_Tokens_from_CatID($smarty, $cat_id);
			
			printf("[%s : %d] tokens => %d", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, count($tokens));
			
			echo "<br>"; echo "<br>";
			
			$histo = Utils::get_Histogram($tokens);

			printf("[%s : %d] histo => %d", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__, count($histo));
			
			echo "<br>"; echo "<br>";

			/*******************************
				debug: view
			*******************************/
			$smarty->assign("histo", array_slice($histo, 0, 100));
// 			$smarty->assign("histo", array_slice($histo, 0, 50));
// 			$smarty->assign("histo", array_slice($histo, 0, 20));
			
			$header = array(
						
					"SN",
					"db ids",
					"form",
					"hin",
					"hin_1",
					"hin_2",
					"hin_3",
					"histo",
			);
			
			$smarty->assign("header", $header);
				
			/*******************************
				write file
			*******************************/
			$fname = "../data/histo_file_cat=$cat_id.csv";

			$fout = fopen($fname, "w");
			
			$histo_file_size = CONS::$histo_file_size;
			
			$hs = array_slice($histo, 0,$histo_file_size);
// 			$hs = array_slice($histo, 0,10);
			
			$count = 0;
			
// 			printf("[%s : %d] \$hs[5] => ", 
// 							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
			
// 			echo "<br>"; echo "<br>";
			
// 			var_dump($hs[array_keys($hs)[5]]);
			
			foreach ($hs as $h) {
				
				$tmp = array(
					
						$h['db_id'],
						$h['form'],
						
						$h['hin'],
						$h['hin_1'],
						$h['hin_2'],
						$h['hin_3'],
						$h['histo'],
						
				);
				
// 				var_dump($h);
				
// 				echo "<br>"; echo "<br>";
				
// 				printf("[%s : %d] db_id => %s", 
// 								Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
// 								__LINE__, $h['db_id']);
// // 								__LINE__, $h->get_db_id());

// 				echo "<br>"; echo "<br>";
				
// 				echo "<br>"; echo "<br>";
				
				
// 				$tmp = array(
					
// 						$h->get_db_id(),
// 						$h->get_form(),
// 						$h->get_hin(),
// 				);
				
// 				$res = fputcsv($fout, $h);
				$res = fputcsv($fout, $tmp);
				
				if ($res != false) {
					
					$count ++;
					
				}
				
			}
			
			fclose($fout);
			
			printf("[%s : %d] csv written => %d lines out of %d", 
							Utils::get_Dirname(__FILE__, CONS::$proj_Name), 
							__LINE__, $count, count($hs));
			
			echo "<br>"; echo "<br>";
			
// 			/*******************************
// 				test
// 			*******************************/
// 			$h = $histo[array_keys($histo)[10]];
// // 			$h = $histo[10];
			
// 			$ser = serialize($h);
			
// 			printf("[%s : %d] serialized => ", 
// 							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
			
			
// 			var_dump($ser);
			
// 			$obj = unserialize($ser);
			
// 			printf("[%s : %d] unserialize => ", 
// 							Utils::get_Dirname(__FILE__, CONS::$proj_Name), __LINE__);
			
			
// 			var_dump($obj);
			
// 			echo "<br>"; echo "<br>";
			
		}//create_HistoFile_from_CatID
		
	}//class Utils
	
	