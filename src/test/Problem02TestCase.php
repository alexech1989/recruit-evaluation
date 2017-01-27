<?php

  require_once realpath(dirname(__FILE__) . '/../bootstrap.php');

  use \RecruIT\Evaluation\Helpers\CompleteRange;

  $cr = CompleteRange::getInstance();

  print(formatOutput($cr->build([1, 2, 4, 5])));
  print(formatOutput($cr->build([2, 4, 9])));
  print(formatOutput($cr->build([55, 58, 60])));

  function formatOutput($sequence)
  {
    $text = implode(', ', $sequence);
    return "[{$text}]\n";
  }

 ?>
