<?php

  require '../../vendor/autoload.php';

  use \RecruIT\Evaluation\Web\Rest\Controllers\EmployeeController;
  use \RecruIT\Evaluation\Web\Services\EmployeeService;
  use \RecruIT\Evaluation\Web\Repositories\EmployeeRepository;
  use \RecruIT\Evaluation\Web\Repositories\SourceMappers;

  $config = array(
    'displayErrorDetails' => true,
    'addContentLenghtHeader' => true,
    'outputBuffering' => false
  );

  $app = new \Slim\App(['settings' => $config]);

  $container = $app->getContainer();

  $container['parameters'] = array(
    'templates_path' => realpath(dirname(__FILE__) . '/templates'),
    'cache_path' => realpath(dirname(__FILE__) . '/.cache'),
    'employees_data' => realpath(dirname(__FILE__) . '/data/employees.json')
  );

  $container['view'] = function ($container) {
    $view = new \Slim\Views\Twig($container['parameters']['templates_path'], [
        //'cache' => $container['parameters']['cache_path']
    ]);

    $basePath = rtrim(str_ireplace('index.php', '', $container['request']->getUri()->getBasePath()), '/');
    $view->addExtension(new Slim\Views\TwigExtension($container['router'], $basePath));

    return $view;
  };

  // In that point is possible to implement DI strategy
  $employeeRepository = new EmployeeRepository(
    $container['parameters']['employees_data'],
    ['\\RecruIT\\Evaluation\\Web\\Repositories\\SourceMappers', 'mapEmployees']
  );
  $employeeRepository->populateMemory();

  $employeeService = new EmployeeService($employeeRepository);

  $employeeController = new EmployeeController($employeeService, $container);

  // App routes deficitions
  $app->get('/employees', array($employeeController, 'index'))
    ->setName('app.employees');
  $app->get('/employees/{id}', array($employeeController, 'details'))
    ->setName('app.employee.details');
  $app->get('/employees/download/xml', array($employeeController, 'download'))
    ->setName('app.employees.xml');

  $app->run();

 ?>
