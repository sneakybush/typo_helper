# TypoHelper

Simple wrapper for the PHP's built-in function `levenshtein` will save your time & make your code more readable!

## Status

__Completed__ (*100%*)

## Requirements

You need __PHP 5.4 =<__

## What it looks like

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

## Building docs

```
apigen --source Library/TypoHelper.php --destination docs --php no --title 'TypoHelper'
```

## Running unit tests

```
phpunit
```

## Checking requirements

If you want to send us some modifications, make sure new code doesn't break requirements

```
phpcompatinfo --no-configuration -vvv print --reference PHP5 --report summary Library/TypoHelper.php
```

## License

This project is licensed under the MIT license (see __LICENSE__ for more info)