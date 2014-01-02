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

	/**
	 * @depends testAddOption
	 * @depends testAddManyOptions
	 */ 

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
}