<?php

/**
 *	orされたhtaccessを全パターン抽出する
 *  php preg_ht.php 'example/(e|x|a|m|p|l)/index.html' '/example/hoge/$1/index.html'
 *  result:
 *	/example/e/index.html   /example/hoge/e/index.html
 *  /example/x/index.html   /example/hoge/x/index.html
 *  ...(省略)
 *
 *  ２つ以上の正規表現出力には対応していない。
 */

$src = "/" . str_replace("\\", "", $argv[1]);
$out = $argv[2];

$keywords = preg_split("/[(|)]/", $src); 
//	最初と最後はゴミなので取り除く
unset($keywords[count($keywords) -1]);
unset($keywords[0]);
$keywords = array_merge($keywords);	//	添字0からの配列に直す

//	文字列入れ替えでリストを作る
for ($i = 0; $i < count($keywords); $i++) {
	$input = preg_replace("/\(.*\)/", $keywords[$i], $src);
	$output = str_replace('$1', $keywords[$i], $out);

	echo "{$input}    {$output}\n";
}


?>