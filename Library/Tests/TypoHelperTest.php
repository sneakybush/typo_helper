<?php

class TypoHelperTest extends PHPUnit_Framework_TestCase
{
	protected $_typoHelper;

	public function __construct ()
	{
		parent::__construct ();
		$this->_typoHelper = (new TypoHelper);
	}

	# $this->_typoHelper againts $this ()
	public function __invoke ()
	{
		return $this->_typoHelper;
	} 

	public function testAddOption ()
	{
		$this ()->addOption ('firefox');
		$this ()->addOption ('opera');
	}

	public function testAddManyOptions ()
	{
		$this ()->addManyOptions (['safari']);
		# one element (opera) is already set
		$this ()->addManyOptions (['chrome', 'ie', 'opera']);
	}

	public function testGetOptions ()
	{
		$this->testAddOption ();
		$this->testAddManyOptions ();

		$expectedResult = ['firefox', 'opera', 'safari', 'chrome', 'ie'];
		$result         = $this ()->getOptions ();

		foreach ($expectedResult as $element)
		{
			if (false === array_search ($element, $result))
			{
				$this->fail (
					sprintf ('Unable to found `%s` in $result', $element)
				);
			}
		}

		$this->assertTrue (true);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */ 

	public function testAddOptionException ()
	{
		$this ()->addOption (null);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */ 

	public function testAddManyOptionsException ()
	{
		$this ()->addManyOptions (false);
	}

	/**
	 * @expectedException InvalidArgumentException
	 */

	public function testPassedStringIsTooLong ()
	{
		$maxLength = 255;
		# Whoops!
		$this ()->addOption (str_repeat ('#', $maxLength + 1));
	}  

	/**
	 * @expectedException InvalidArgumentException
	 */ 

	public function testConstructorException ()
	{
		new TypoHelper (null);
	}

	public function testPrepareString ()
	{
		# by default [toLowerCase => true, trim => true]
		$this ()->addOption (' TesT  ');
		$this->assertEquals  ('test', $this ()->getOptions () [0]);

		$object = new TypoHelper (['trim' => false]);
		$object->addOption ('  Apple  ');
		$this->assertEquals('  apple  ', $object->getOptions () [0]);

		$object = null;

		$object = new TypoHelper (['toLowerCase' => false]);
		$object->addOption ('  HaCKs  ');
		$this->assertEquals  ('HaCKs', $object->getOptions () [0]);
	}

	/**
	 * @expectedException BadMethodCallException
	 */ 

	public function testGetInputException ()
	{
		$this ()->getInput ();
	}

	/**
	 * @expectedException InvalidArgumentException
	 */  

	public function testSetInputException ()
	{
		$this ()->setInput (null);
	}

	public function testSetInput ()
	{
		$this ()->setInput ('mirage');
	} 

	public function testGetInput ()
	{
		$this->testSetInput ();
		$this->assertEquals ($this ()->getInput (), 'mirage');
	}

	
}