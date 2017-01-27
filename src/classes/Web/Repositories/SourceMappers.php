<?php

  namespace RecruIT\Evaluation\Web\Repositories;

  use \RecruIT\Evaluation\Web\Models\EmployeeModel;
  use \RecruIT\Evaluation\Helpers\CurrencyHelper;

  class SourceMappers
  {
    public static function mapEmployees($rawData)
    {
        return array_map(function($data)
        {
          return (new EmployeeModel)
            ->setId($data->id)
            ->setIsOnline($data->isOnline)
            ->setSalary($data->salary)
            ->setAge($data->age)
            ->setPosition($data->position)
            ->setName($data->name)
            ->setGender($data->gender)
            ->setEmail($data->email)
            ->setPhone($data->phone)
            ->setAddress($data->address)
            ->setSkills(array_map(function($skill)
            {
              return $skill->skill;
            }, $data->skills));

        }, $rawData);
    }
  }

 ?>
