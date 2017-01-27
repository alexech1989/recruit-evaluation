<?php

  namespace RecruIT\Evaluation\Helpers;

  abstract class HelperBase implements IHelper
  {
    protected static $instance;

    protected function __construct() { }

    final private function __clone() { }

    public static function getInstance()
    {
      if (is_null(static::$instance))
      {
        $class = get_called_class();
        static::$instance = new $class;
      }

      return static::$instance;
    }

    abstract public function build($input);
  }

 ?>
