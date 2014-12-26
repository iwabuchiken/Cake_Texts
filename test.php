<?php

function test_Regex_ShowResult($url, $pattern) {

	echo "url => $url";
	echo "\n";
	
	echo "pattern => $pattern";
	echo "\n";
	
	preg_match($pattern, $url, $matches);
	
	if (count($matches) > 1) {
	
	echo $matches[1];;
	
	} else {
	
	echo "No matches";
	
	}

	echo "\n";
	print_r($matches);
	
}//function test_Regex_ShowResult()

function test_Regex() {

	/******************************
	
		Round: 1
	
	******************************/
	echo "\n";
	echo "=========== <1> ===========";
	echo "\n";
			
	$url = "https://www.youtube.com/watch?v=imc4xQDp_Fs&list=WL&undex=32";

	$pattern = '/\?v=(.+?)&/';
	
	test_Regex_ShowResult($url, $pattern);
	
	echo "\n";
	
	/******************************
	
		Round: 2
	
	******************************/
	echo "\n";
	echo "=========== <2> ===========";
	echo "\n";
			
	$pattern = '/\?v=(.+?)&?/';
	
	test_Regex_ShowResult($url, $pattern);
	
	echo "\n";
	
	/******************************
	
		Round: 3
	
	******************************/
	echo "\n";
	echo "=========== <3> ===========";
	echo "\n";
			
	$pattern = '/\?v=(.+?)&*/';
	
	test_Regex_ShowResult($url, $pattern);
	
	echo "\n";
	
	/******************************
	
		Round: 4
	
	******************************/
	echo "\n";
	echo "=========== <4> ===========";
	echo "\n";
			
// 	$pattern = '/([a-z]+)/g';
	$pattern = '/([a-z]+)/';	// Array
								// (
								//     [0] => https
								//     [1] => https
								// )
// 	$pattern = '/[a-z]+/';
	
	test_Regex_ShowResult($url, $pattern);
	
	echo "\n";
	
	/******************************
	
		Round: 5
	
	******************************/
	echo "\n";
	echo "=========== <5> ===========";
	echo "\n";
			
// 	$pattern = '/([a-z]+)/g';
	$pattern = '/\?v=(.+)?&*/';	// [1] => imc4xQDp_Fs&list=WL&undex=32
	
	test_Regex_ShowResult($url, $pattern);
	
	echo "\n";
	
	/******************************
	
		Round: 6
	
	******************************/
	echo "\n";
	echo "=========== <6> ===========";
	echo "\n";
			
// 	$pattern = '/([a-z]+)/g';
	$pattern = '/\?v=(.+)?&{0,1}/';	//
// 	$pattern = '/\?v=(.+)?&?/';	// [1] => imc4xQDp_Fs&list=WL&undex=32
	
	test_Regex_ShowResult($url, $pattern);
	
	echo "\n";
	
}

function test_ArrayPush() {
	
	$a = array();
	
	$a[0] = array();
	$a[1] = array();
	
	array_push($a[0], 111);
	array_push($a[1], 22);
	
	print_r($a);
	
}

function test_PrefMatch() {

	setlocale(LC_ALL, 'ja_JP.UTF-8');
	
	$s = "関西を医療のメッカに、大阪でフォーラム−有識者8人が議論";
	
	$p = "医療";
	
	$res = preg_match($p, $s, $matches);
	
	echo "\$res => ".$res;
	
	echo "\n";
	
	echo "\$matches => ".$matches;
	
	echo "\n";
	
	echo "mb_strlen => ".mb_strlen($s);
	
	echo "\n";
	
	echo "s => ".$s;
	
	echo "\n";
	
	echo "s, mb_convert_encoding => ".mb_convert_encoding($s, "SJIS", "UTF-8");
	
	echo "\n";
	
	echo "strlen(mb_convert_encoding => ".strlen(mb_convert_encoding($s, "SJIS", "UTF-8"));
	
	echo "\n";
	
	echo "mb_strlen(mb_convert_encoding => "
			.mb_strlen(mb_convert_encoding($s, "SJIS", "UTF-8"));
	
	echo "\n";
	
	echo "mb_strlen(\$s, \"SJIS\") => "
			.mb_strlen($s, "SJIS");
	
	echo "\n";
	
	echo "mb_strlen(\$s, \"UTF-8\") => "
			.mb_strlen($s, "UTF-8");
	
	
	
}

function 
test_PrefMatch_2() {

	setlocale(LC_ALL, 'ja_JP.UTF-8');
	
// 	$s = "関西を医療のメッカに、大阪でフォーラム−有識者8人が議論";
	$s = "関西を医療のメッカに、大阪でフォーラム医療−有識者8人が議論";
	
	$s2 = mb_convert_encoding($s, "SJIS", "UTF-8");
	
	$reg = mb_convert_encoding("医療", "SJIS", "UTF-8");
	
	echo "\$reg => $reg";
	
	$p = "/$reg/";
// 	$p = "/医療/";
	echo "\n";
	
	$res = preg_match($p, $s2, $matches);
	
	echo "\$res => ".$res;
	
	echo "\n";

	print_r($matches);
// 	echo "\$matches => ".$matches;
	
	
	echo "\n";
	
	echo "mb_strlen(\$s, \"UTF-8\") => "
			.mb_strlen($s, "UTF-8");
	
	
	
}//test_PrefMatch2

function 
test_PrefMatch_3__MatchAll() {

	setlocale(LC_ALL, 'ja_JP.UTF-8');
	
// 	$s = "関西を医療のメッカに、大阪でフォーラム−有識者8人が議論";
	$s = "関西を医療のメッカに、大阪でフォーラム医療−有識者8人が議論";
	
	$s2 = mb_convert_encoding($s, "SJIS", "UTF-8");
	
	echo "s2 => $s2";
	
	echo "\n";
	
	$reg = mb_convert_encoding("医療", "SJIS", "UTF-8");
	
	echo "\$reg => $reg";
	
	$p = "/$reg/";
// 	$p = "/医療/";
	echo "\n";
	
	$res = preg_match_all($p, $s2, $matches);
	
	echo "\$res => ".$res;
	
	echo "\n";

	echo "matches----------------------------\n";
	print_r($matches);
// 	echo "\$matches => ".$matches;
	
	
	echo "\n";
	
	//REF http://blog.ishitoya.info/entry/20090707/1246970868
	echo "mb_strlen(\$s, \"UTF-8\") => "
			.mb_strlen($s, "UTF-8");
	
	
	
}//test_PrefMatch_3__MatchAll

function 
test_Replace() {

	setlocale(LC_ALL, 'ja_JP.UTF-8');
	
	// 	$s = "関西を医療のメッカに、大阪でフォーラム−有識者8人が議論";
	$s = "関西を医療のメッカに、大阪でフォーラム医療−有識者8人が議論";
	
	$s2 = mb_convert_encoding($s, "SJIS", "UTF-8");
	
	echo "s2 => $s2";
	
	echo "\n";
	
	$reg = mb_convert_encoding("医療", "SJIS", "UTF-8");

	$res = str_replace($reg, "<b>".$reg."</b>", $s2);
	
	print_r($res);
	
	
}//test_Replace

function 
test_Sanitize() {

	setlocale(LC_ALL, 'ja_JP.SJIS');
	
	$str = "信長に「名古屋ことば」を　河村<font color=\"blue\">市長</font>、ＮＨＫに要望";
	
	print_r(mb_convert_encoding($str, "SJIS", "UTF-8"));
	
// 	$p = "\<.+\>";
// 	$p = "<.+>";
// 	$p = "/<.+>/";
// 	$p = "/<.+>/";
 	$p2 = "/<.+?>(.+)<\/font>/";
	$p = "/<font .+?>(.+)<\/font>/";
	
	$res = preg_match($p, $str, $matches);
	
	echo "\$res => ".$res;
	
	echo "\n";
	
	print_r($matches);
// 	echo "\$matches => ".$matches;
	
	
}//test_Sanitize

function 
test_Sanitize_Replace() {

	setlocale(LC_ALL, 'ja_JP.SJIS');
	
	$str = "信長に「名古屋ことば」を　河村<font color=\"blue\">市長</font>、ＮＨＫに要望";
	
	print_r(mb_convert_encoding($str, "SJIS", "UTF-8"));
	
	echo "\n";
	echo "\n";
	
// 	$p = "\<.+\>";
// 	$p = "<.+>";
// 	$p = "/<.+>/";
// 	$p = "/<.+>/";
 	$p2 = "/<.+?>(.+)<\/font>/";
 	$p3 = "/<font .+?>(.+)<\/font>/";
 	
	$p4 = "/<font.+?>(.+)<\/font>/";
 	$tag = "font";
	$p = "/<$tag.+?>(.+)<\/$tag>/";
	
	$rep = '${1}';
	
	$res = preg_replace($p, $rep, $str);
	
// 	echo "\$res => ".$res;
	
// 	echo "\n";
	
	print_r(mb_convert_encoding($res, "SJIS", "UTF-8"));
// 	print_r($res);
// 	echo "\$matches => ".$matches;
	
	
}//test_Sanitize_Replace

function 
test_Get_Type() {
	
	setlocale(LC_ALL, 'ja_JP.SJIS');
	
	$str = "信長に「名古屋ことば」を　河村市長、ＮＨＫに要望";
	
	print_r(mb_convert_encoding($str, "SJIS", "UTF-8"));	
	
	echo mb_strlen($str, "UTF-8");
// 	echo mb_strlen($str);
	
// 	foreach ($str as $chr) {
	for ($i = 0; $i < mb_strlen($str, "SJIS"); $i++) {
// 	for ($i = 0; $i < mb_strlen($str, "UTF-8"); $i++) {
		
// 		echo $str[$i];
		echo mb_convert_encoding($str, "SJIS", "UTF-8")[$i];
			
		echo "\n";
		
// 		echo $chr;
		
// 		if (!preg_match("/^[ぁ-ん]+$/u",$chr)) {
			
// 			print_r($chr);
				
// 			$flag = false;
				
// 			break;
				
// 		};
			
	}
	
}//test_Get_Type

function
test_PregMatch_EQ_TimeLabel() {

	$str = "2014年9月14日 12時52分ごろ";
	
	$str = mb_convert_encoding($str, "SJIS", "UTF-8");

	print_r($str);
	echo "\n";
	
	$p = "/\d+/i";
// 	$p = "/\d+?/i";
// 	$p = "/\d+?/";
	
	$res = preg_match_all($p, $str, $matches);

	/**********************************
	* matches?
	**********************************/
	if ($res == 0) {
		
		echo "no matches";
		echo "\n";
		
	} else if ($res == FALSE) {

		echo "FALSE";
		echo "\n";
		
	} else {
		
		echo "res => ";
// 		print_r($matches);
// 		print_r($matches[0]);
		
		$label = _conv_Match_to_DateLabel($matches[0]);
		
	}
	
}//test_PregMatch_EQ_TimeLabel

function
_conv_Match_to_DateLabel
($match) {
	
	print_r($match);
	
	arsort($match);
	
	print_r($match);
	
	for ($i = 0; $i < count($match); $i++) {

		$num_str = (string) $match[$i];

		$len = strlen($num_str);
		
		if ($len == 1) {
			
			$num_str = "0".$num_str;
			
		}
		
// 		echo $num_str."(".strlen($num_str).")";
// 		echo "\n";
		
		$match[$i] = $num_str;
		
// 		echo $match[$i]."(".$match[$i].length.")";
		
	}
	
	print_r($match);
	
	arsort($match);
// 	asort($match);
	
	print_r($match);
	
}//_conv_Match_to_DateLabel

function
execute() {

	test_PregMatch_EQ_TimeLabel();
// 	test_Get_Type();
// 	test_Sanitize_Replace();
// 	test_Sanitize();
// 	test_Replace();
// 	test_PrefMatch_3__MatchAll();
// 	test_PrefMatch_2();
// 	test_PrefMatch();
	
// 	test_ArrayPush();
	
// 	test_Regex();
	
}

execute();
