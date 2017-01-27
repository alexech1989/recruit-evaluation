<?php

  require_once realpath(dirname(__FILE__) . '/../bootstrap.php');

  use \RecruIT\Evaluation\Helpers\ClearPar;

  $cp = ClearPar::getInstance();

  print($cp->build('()())()') . "\n");
  print($cp->build('()(()') . "\n");
  print($cp->build(')(') . "\n");
  print($cp->build('((()') . "\n");

 ?>
