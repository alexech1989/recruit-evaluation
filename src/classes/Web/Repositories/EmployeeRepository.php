<?php

  namespace RecruIT\Evaluation\Web\Repositories;

  use \RecruIT\Evaluation\Web\Infrastructure\WebApiInMemoryRepository;

  class EmployeeRepository extends WebApiInMemoryRepository
    implements IEmployeeRepository
  {
    public function __construct($resourceUri, $initCallback)
    {
      parent::__construct($resourceUri, $initCallback);
    }

    public function getAll()
    {
      $clone = $this->repository;
      return $clone;
    }

    public function findById($id)
    {
      $lookup = array_values(
        array_filter($this->repository, function($object) use($id) {
          return $object->getId() === $id;
        })
      );

      return !empty($lookup) ? $lookup[0] : null;
    }

    public function searchByEmail($email)
    {
      return array_values(
        array_filter($this->repository, function($object) use($email) {
          return strpos(strtolower($object->getEmail()), strtolower($email)) !== false;
        })
      );
    }
  }

 ?>
