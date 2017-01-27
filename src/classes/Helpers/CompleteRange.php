<?php

  namespace RecruIT\Evaluation\Helpers;

  class CompleteRange extends HelperBase
  {
    public function build($input)
    {
      $isNumericArray = $this->checkNumerability($input);

       if (!$isNumericArray)
       {
         throw new Exception('The input array only must contain positive integers.');
       }

       sort($input, \SORT_NUMERIC);

       $last = $input[0];
       $aux = [$last];

       for ($i = 1; $i < count($input); ++$i)
       {
         $merge = [];

          if ($input[$i] === ($last + 1))
          {
            $merge[] = $input[$i];
          }
          else
          {
             while (++$last <= $input[$i])
             {
               $merge[] = $last;
             }
          }

          $aux = array_merge($aux, $merge);
          $last = $input[$i];
       }

       return $aux;
    }

    public function buildLite($input)
    {
      $isNumericArray = $this->checkNumerability($input);

      if (!$isNumericArray)
      {
        throw new Exception('The input array only must contain positive integers.');
      }

      $minInt = min($input);
      $maxInt = max($input);

      return range($minInt, $maxInt);
    }

    private function checkNumerability($sequence)
    {
      return array_reduce($sequence, function ($isNumeral, $value)
      {
         return $isNumeral && (is_int($value) || (int)$value > 0) && $value > 0;
      }, true);
    }

  }

 ?>
