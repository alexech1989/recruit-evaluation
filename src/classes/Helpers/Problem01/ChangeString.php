<?php

  namespace RecruIT\Evaluation\Helpers;

  class ChangeString extends HelperBase
  {
    private static $alphabetMap = array(
      'a' => 'b', 'b' => 'c', 'c' => 'd',
      'd' => 'e', 'e' => 'f', 'f' => 'g',
      'g' => 'h', 'h' => 'i', 'i' => 'j',
      'j' => 'k', 'k' => 'l', 'l' => 'm',
      'm' => 'n', 'n' => 'ñ', 'ñ' => 'o',
      'o' => 'p', 'p' => 'q', 'q' => 'r',
      'r' => 's', 's' => 't', 't' => 'u',
      'u' => 'v', 'v' => 'w', 'w' => 'x',
      'x' => 'y', 'y' => 'z', 'z' => 'a'
    );

    public function build($input)
    {
      $letters = str_split($input);

      array_walk($letters, function($letter, $index, $alphabet) use (&$input)
      {

        $lookup = strtolower($letter);

        if (array_key_exists($lookup, $alphabet))
        {
          $replacement = ctype_upper($letter) ? strtoupper($alphabet[$lookup]) : $alphabet[$lookup];
          $input = substr_replace($input, $replacement, $index, 1);
        }

      }, static::$alphabetMap);

      return $input;
    }
  }

 ?>
