<?php

  namespace RecruIT\Evaluation\Web\Services;

  use \RecruIT\Evaluation\Web\Repositories\IEmployeeRepository;
  use \RecruIT\Evaluation\Helpers\CurrencyHelper;

  class EmployeeService implements IEmployeeService
  {
    private $employeeRepository;

    public function __construct(IEmployeeRepository $employeeRepository)
    {
      $this->employeeRepository = $employeeRepository;
    }

    public function getAll()
    {
      return $this->employeeRepository->getAll();
    }

    public function findById($id)
    {
      return $this->employeeRepository->findById($id);
    }

    public function searchByEmail($email)
    {
      return $this->employeeRepository->searchByEmail($email);
    }

    public function searchBySalaryRange($min, $max)
    {
      $employees = $this->getAll();

      return array_values(
        array_filter($employees, function($employee) use($min, $max)
        {
          $salary = floatval(CurrencyHelper::parseDollars($employee->getSalary()));

          return $salary >= $min && $salary <= $max;
        })
      );
    }

    public function getBySalaryRangeAsXml($min, $max)
    {
      $xml = new \SimpleXMLElement('<employees></employees>');
      $employees = $this->searchBySalaryRange($min, $max);

      foreach ($employees as $employee)
      {
        $employeeTag = $xml->addChild('employee');
        $employeeTag->addChild('id', $employee->getId());
        $employeeTag->addChild('isOnline', $employee->getIsOnline());
        $employeeTag->addChild('salary', $employee->getSalary());
        $employeeTag->addChild('age', $employee->getAge());
        $employeeTag->addChild('position', $employee->getPosition());
        $employeeTag->addChild('name', $employee->getName());
        $employeeTag->addChild('gender', $employee->getGender());
        $employeeTag->addChild('email', $employee->getEmail());
        $employeeTag->addChild('phone', $employee->getPhone());
        $employeeTag->addChild('address', $employee->getAddress());
        $employeeTag->addChild('skills', implode(',', $employee->getSkills()));
      }

      return $xml->asXML();
    }
  }

 ?>
