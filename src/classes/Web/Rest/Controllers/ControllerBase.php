<?php

  namespace RecruIT\Evaluation\Web\Rest\Controllers;

  abstract class ControllerBase
  {
    protected $container;
    protected $view;

    protected function __construct($container)
    {
      $this->container = $container;

      if (isset($this->container['view']))
      {
        $this->view = $this->container['view'];
      }
    }

  }

 ?>
