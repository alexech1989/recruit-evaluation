<?php
  namespace RecruIT\Evaluation\Helpers;

  class CurrencyHelper
  {
    public static function parseDollars($money)
    {
      return floatval(str_replace(['$', ','], '', $money));
    }
  }

 ?>
