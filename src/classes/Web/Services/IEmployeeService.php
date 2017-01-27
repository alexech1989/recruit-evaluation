<?php

  namespace RecruIT\Evaluation\Web\Services;

  interface IEmployeeService
  {
    public function getAll();
    public function findById($id);
    public function searchByEmail($email);
    public function searchBySalaryRange($min, $max);
    public function getBySalaryRangeAsXml($min, $max);
  }
 ?>
