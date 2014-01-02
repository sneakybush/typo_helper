<?php

error_reporting (-1);
ini_set ('display_errors', true);

require_once (__DIR__ . '/Library/TypoHelper.php');

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