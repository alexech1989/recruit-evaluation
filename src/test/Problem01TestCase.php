<?php

  require_once realpath(dirname(__FILE__) . '/../bootstrap.php');

  use \RecruIT\Evaluation\Helpers\ChangeString;

  $cs = ChangeString::getInstance();

  print($cs->build('123 abcd*3') . "\n");
  print($cs->build('**Casa 52') . "\n");
  print($cs->build('**Casa 52Z') . "\n");

 ?>
