<?php

  namespace RecruIT\Evaluation\Web\Repositories;

  interface IEmployeeRepository
  {
    public function getAll();
    public function findById($id);
    public function searchByEmail($email);
  }

 ?>
