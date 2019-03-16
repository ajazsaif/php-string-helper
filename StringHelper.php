<?php
/**
 *
 * @package	StringHelpers
 * @author	Ajaz Alam(ajazaalam@gmail.com)
 */

// ------------------------------------------------------------------------

if( ! function_exists('trimSlashes') )
{
	/**
	 * Trim Slashes
	 *
	 * Removes any leading/trailing slashes from a string:
	 *
	 * /this/that/theother/
	 *
	 * becomes:
	 *
	 * this/that/theother
	 * @param	string
	 * @return	string
	 */

	function trimSlashes($str)
	{
		return trim($str, '/');
	}
}

// ------------------------------------------------------------------------
if(! function_exists('strip_slashes') )
{
	/**
	 * Strip Slashes
	 *
	 * Removes slashes contained in a string or in an array
	 *
	 * @param	mixed	string or array or closoure with argument
	 * @return	mixed	string or array
	 */

	function strip_slashes($str,$callback = NULL)
	{
		if(! is_array($str))
		{
			return stripslashes($str);
		}
		if(is_callable($callback))
		{
			return $callback(stripslashes($str));
		}

		foreach ($str as $key => $value)
		{
			$str[$key]	=	strip_slashes($value);
		}

		return $str;
	}
}

// ------------------------------------------------------------------------

if(! function_exists('stripQuotes') )
{
	/**
	 * Strip Quotes
	 *
	 * Removes single and double quotes from a string
	 *
	 * @param	string
	 * @return	string
	 */

	function stripQuotes($str)
	{
		return str_replace(array('"', "'"), '', $str);
	}
}

// ------------------------------------------------------------------------

if(! function_exists('quotesToEntities') )
{
	/**
	 * Quotes to Entities
	 *
	 * Converts single and double quotes to entities
	 *
	 * @param	string
	 * @return	string
	 */

	function quotesToEntities($str)
	{
		return str_replace(array("\'","\"","'",'"'),array("&#39;","&quot;","&#39;","&quot;"), $str);
	}
}

// ------------------------------------------------------------------------

if(! function_exists('reduceDoubleSlashes') )
{
	/**
	 * Reduce Double Slashes
	 *
	 * Converts double slashes in a string to a single slash,
	 * except those found in http://
	 *
	 * http://www.example.com//index.php
	 *
	 * becomes:
	 *
	 * http://www.example.com/index.php
	 *
	 * @param	string
	 * @return	string
	 */

	function reduceDoubleSlashes($str)
	{
		return preg_replace('#(^|[^:])//+#', '\\1/', $str);
	}
}

// ------------------------------------------------------------------------

if(! function_exists('reduceMultiples') )
{
	/**
	 * Reduce Multiples
	 *
	 * Reduces multiple instances of a particular character.  Example:
	 *
	 * Fred, Bill,, Joe, Jimmy
	 *
	 * becomes:
	 *
	 * Fred, Bill, Joe, Jimmy
	 *
	 * @param	string
	 * @param	string	the character you wish to reduce
	 * @param	bool	TRUE/FALSE - whether to trim the character from the beginning/end
	 * @return	string
	 */

	function reduceMultiples($str, $character = ',',$trim = FALSE)
	{
		$str = preg_replace('#'.preg_quote($character, '#').'{2,}#', $character, $str);

		return ($trim === TRUE) ? trim($str, $character) : $str;
	}
}

// ------------------------------------------------------------------------

if(! function_exists('randomString'))
{
	/**
	 * Create a Random String
	 *
	 * Useful for generating passwords or hashes.
	 *
	 * @param	string	type of random string.  basic, alpha, alnum, numeric, nozero, unique, md5, encrypt and sha1
	 * @param	int	number of characters
	 * @return	string
	 */

	function randomString($type = 'alnum', $len = 8)
	{
		switch ($type) 
		{
			case 'basic':
				return mt_rand();
				break;
			case 'alnum':
			case 'numeric':
			case 'nozero':
			case 'alpha':

			switch ($type)
			{
				case 'alpha':
					$pool = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					break;
				case 'alnum':
					$pool =	'0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
					break;
				case 'numeric':
					$pool =	'0123456789';
					break;
				case 'nozero':
					$pool = '123456789';
					break;
			}

			return substr(str_shuffle(str_repeat($pool, ceil($len/strlen($pool)))), 0, $len);
			case 'unique':
			case 'md5':
				return md5(uniqid(mt_rand()));
				break;
			case 'encrypt':
			case 'sha1':
				return sha1(uniqid(mt_rand(), TRUE));
		}
	}
}

// ------------------------------------------------------------------------

if(! function_exists('incrementString'))
{
	/**
	 * Add's _1 to a string or increment the ending number to allow _2, _3, etc
	 *
	 * @param	string	required
	 * @param	string	What should the duplicate number be appended with
	 * @param	string	Which number should be used for the first dupe increment
	 * @return	string
	 */

	function incrementString($str, $separator = '_', $first = 1)
	{
		preg_match('/(.+)'.preg_quote($separator, '/').'([0-9]+)$/', $str, $match);
		return isset($match[2]) ? $match[1].$separator.($match[2] + 1) : $str.$separator.$first;
	}
}

// ------------------------------------------------------------------------

if(! function_exists('alternator'))
{
	/**
	 * Alternator
	 *
	 * @param	string (as many parameters as needed)
	 * @return	string
	 */

	function alternator()
	{
		static $i;

		if(func_num_args() === 0)
		{
			$i = 0;
			return '';
		}
		$args = func_get_args();
		return $args[($i++ % count($args))];
	}
}

// ------------------------------------------------------------------------

if(! function_exists('repeator'))
{
	/**
	 * Repeater function
	 * @param	string	$data	String to repeat
	 * @param	int	$num	Number of repeats
	 * @return	string
	 */

	function repeator($data, $num = 1)
	{
		return ($num > 0) ? str_repeat($data, $num) : '';  
	}
}