# TypoHelper

Simple wrapper for the PHP's built-in function `levenshtein` will save your time & make your code more readable!

## Status

In work (*10%*), __not completed__


You will need __PHP 5.4__ (at least) 

## What it is going to look like

```php
$userInput = 'javaskript'; # what a stupid typo!

$typoHelper = (new TypoHelper);

$typoHelper->addOption ('apple');
$typoHelper->addManyOptions (['sex', 'rock-n-roll', 'javascript']);
$typoHelper->setInput ($userInput);

if ($typoHelper->hasEqual ())
{
	echo sprintf ('Found %s', $userInput); 
}
else
{
	echo sprintf ('Did you mean %s?', $typoHelper->findClosest ());
}
```
The output will be `Did you mean javascript?`

## License

This project is licensed under the MIT license (see __LICENSE__ for more info)