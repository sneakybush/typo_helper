<?php

/**
 * TypoHelper class
 * @author  Ilya
 * @license MIT
 */ 

class TypoHelper
{
	/**
	 * @var array options
	 */

	protected $_options;

	/**
	 * @var null|string input
	 */ 

	protected $_input;

	/**
	 * The constructor
	 */ 

	public function __construct ()
	{
		$this->_input   = null;
		$this->_options = [];
	}	

	/**
	 * Adds an option to the list
	 * @see $_options
	 * @param string $option option
	 * @throws InvalidArgumentException
	 */

	public function addOption ($option)
	{
		if (!is_string ($option))
		{
			throw new InvalidArgumentException (
				'$option must be of the type STRING; '
				. gettype ($option)
				. ' passed'
			);
		}

		$this->_checkLength ($option);
		$this->_options [] = $option;
	}

	/**
	 * Adds multiple options to the list at once
	 * @see addOption
	 * @see $_options
	 * @param array $options options
	 * @throws InvalidArgumentException
	 */

	public function addManyOptions ($options)
	{
		if (!is_array ($options))
		{
			throw new InvalidArgumentException (
				'$options must be of the type ARRAY; '
				. gettype ($options)
				. ' passed'
			);
		}

		foreach ($options as $option)
		{
			$this->addOption ($option);
		}
	}  

	/**
	 * Returns all options added
	 * @return array 
	 */

	public function getOptions ()
	{
		return $this->_options;
	}  

	/**
	 * Setter for $_input
	 * @see $_input
	 * @param string $input
	 */

	public function setInput ($input)
	{
		if (!is_string ($input))
		{
			throw new InvalidArgumentException (
				'$option must be of the type STRING; '
				. gettype ($input)
				. ' passed'
			);
		}

		$this->_checkLength ($input);
		$this->_input = $input;
	}  

	/**
	 * Getter for $_input
	 * @see $_input
	 * @throws BadMethodCallException
	 * @return null|string
	 */ 

	public function getInput ()
	{
		if (is_null ($this->_input))
		{
			throw new BadMethodCallException (
				'TypoHelper::$_input must NOT be of the type NULL; '
				. 'Please set input using TypoHelper::setInput ()'
			);
		}

		return $this->_input;
	}

	/**
	 * Checks if $_input has equals in $_options
	 * @see $_input
	 * @see $_options
	 * @return boolean
	 */

	public function hasEqual ()
	{
		$input   = $this->getInput ();
		$options = $this->getOptions ();

		foreach ($options as $option)
		{
			if ( ($option) == $input )
			{
				return true;
			}
		}

		return false;
	}  

	/**
	 * Returns the closest (to input) option  
	 * @see http://php.net/manual/en/function.levenshtein.php
	 * @return string|null
	 */

	public function findClosest ()
	{
		$input   = $this->getInput ();
		$options = $this->getOptions ();

		$closestWord      = null;
		$shortestDistance = -1; # means no shortest distance found, yet

		# when string are equal, levenshtein () will return 0 
		# see docs for more info
		$exactMatch = 0; 

		foreach ($options as $option)
		{
			$result = levenshtein ($option, $input);

			# exact match?
			if ($exactMatch == $result)
			{
				$closestWord      = $option;
				$shortestDistance = $exactMatch;

				break;
			}

			if ( 
					($result <= $shortestDistance) 
					|| ($shortestDistance < $exactMatch) 
			   )
			{
				$closestWord      = $option;
				$shortestDistance = $result;
			}
		}

		return $closestWord;
	}  	

	/**
	 * Checks length
	 * @param string $string string
	 * @throws InvalidArgumentException
	 * @see http://php.net/manual/en/function.levenshtein.php
	 */ 

	protected function _checkLength ($string)
	{
		$maxLength = 255; 
		$string    = (string) $string;

		if (strlen ($string) > $maxLength)
		{
			throw new InvalidArgumentException (
				'Passed string must NOT be longer than '
				. $maxLength
				. '; '
				. strlen ($string)
				. ' symbols passed'
			);
		}
	}
}