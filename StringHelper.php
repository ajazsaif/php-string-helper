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