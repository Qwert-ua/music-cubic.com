<?php

class Translit {

	public static function in($str) 
	{
	    return strtr($str, self::listLetters());
	}
	
	public static function out($str) 
	{
	    return strtr($str,array_flip( self::listLetters()));
	}
	
	public static function slug($str, $separator = '-')
	{
		return trim(Str::slug(strtr($str, self::listLetters()), $separator));
	}
	
	public static function listLetters()
	{
		$tr = array(
		    "А"=>"A",
		    "Б"=>"B",
		    "В"=>"V",
		    "Г"=>"H",
		    "Ґ"=>"G",
		    "Д"=>"D",
		    "Е"=>"E",
		    "Є"=>"Ye",
		    "Ж"=>"Zh",
		    "З"=>"Z",
		    "И"=>"Y",
		    "І"=>"I",
		    "Ї"=>"Yi",
		    "Й"=>"Y",
		    "К"=>"K",
		    "Л"=>"L",
		    "М"=>"M",
		    "Н"=>"N",
		    "О"=>"O",
		    "П"=>"P",
		    "Р"=>"R",
		    "С"=>"S",
		    "Т"=>"T",
		    "У"=>"U",
		    "Ф"=>"F",
		    "Х"=>"Kh",
		    "Ц"=>"Ts",
		    "Ч"=>"Ch",
		    "Ш"=>"Sh",
		    "Щ"=>"Shch",
		    "Ъ"=>"",
		    "Ы"=>"",
		    "Ь"=>"",
		    "Э"=>"",
		    "Ю"=>"Yu",
		    "Я"=>"Ya",
		    
		    "а"=>"a",
		    "б"=>"b",
		    "в"=>"v",
		    "г"=>"h",
		    "ґ"=>"g",
		    "д"=>"d",
		    "е"=>"e",
		    "є"=>"ie",
		    "ж"=>"zh",
		    "з"=>"z",
		    "і"=>"i",
		    "ї"=>"i",
		    "и"=>"y",
		    "й"=>"i",
		    "к"=>"k",
		    "л"=>"l",
		    "м"=>"m",
		    "н"=>"n",
		    "о"=>"o",
		    "п"=>"p",
		    "р"=>"r",
		    "с"=>"s",
		    "т"=>"t",
		    "у"=>"u",
		    "ф"=>"f",
		    "х"=>"kh",
		    "ц"=>"ts",
		    "ч"=>"ch",
		    "ш"=>"sh",
		    "щ"=>"shch",
		    "ъ"=>"",
		    "ы"=>"",
		    "ь"=>"",
		    "э"=>"e",
		    "ю"=>"iu",
		    "я"=>"ia",
		);
		
		return $tr;
	}

}