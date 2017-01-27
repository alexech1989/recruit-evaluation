<?php

  namespace RecruIT\Evaluation\Helpers;

  class ClearPar extends HelperBase
  {
    public function build($input)
    {
      $strlen = strlen($input);
      $parenthesis = str_split($input);
      $aux = $parenthesis;

      $isParenthesisArray = $this->checkParenthesis($parenthesis);

     if (!$isParenthesisArray)
     {
       throw new Exception('The input string only must contain parenthesis.');
     }

      for ($i = 0; $i < $strlen; ++$i)
      {
         if ($aux[$i] === ')')
         {
            for ($j = ($i - 1); $j >= 0; --$j)
            {
               if ($aux[$j] === '(')
               {
                 $aux[$i] = '*';
                 $aux[$j] = '*';
                 break;
               }
            }
         }
      }

      for ($i = 0; $i < $strlen; ++$i)
      {
         if ($aux[$i] !== '*')
         {
              unset($parenthesis[$i]);
         }
      }

      return implode('', $parenthesis);
    }

    private function checkParenthesis($sequence)
    {
      return array_reduce($sequence, function ($isParenthesis, $value)
      {
        return $isParenthesis && in_array($value, ['(', ')']);
      }, true);
    }

  }

 ?>
