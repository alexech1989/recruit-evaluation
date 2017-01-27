<?php
  namespace RecruIT\Evaluation\Web\Rest\Controllers;

  use \Psr\Http\Message\ServerRequestInterface as Request;
  use \Psr\Http\Message\ResponseInterface as Response;
  use \Interop\Container\ContainerInterface;

  use \RecruIT\Evaluation\Web\Services\IEmployeeService;

  class EmployeeController extends ControllerBase
  {
    private $employeeService;

    public function __construct(IEmployeeService $employeeService,
      ContainerInterface $container)
    {
      $this->employeeService = $employeeService;
      parent::__construct($container);
    }

    public function index(Request $request, Response $response)
    {
      $email = $request->getQueryParam('email', $default = null);

      if (!$email)
      {
        return $this->view->render($response, 'employees/index.html', [
          'employees' => $this->employeeService->getAll()
        ]);
      }

      return $this->view->render($response, 'employees/index.html', [
        'employees' => $this->employeeService->searchByEmail($email)
      ]);
    }

    public function details(Request $request, Response $response)
    {
      $id = $request->getAttribute('id');

      return $this->view->render($response, 'employees/details.html', [
          'employee' => $this->employeeService->findById($id)
      ]);
    }

    public function download(Request $request, Response $response)
    {
      return $response
        ->withHeader('Content-Type', 'text/xml')
        ->withHeader('Pragma', 'public')
        ->withHeader('Content-Disposition', 'attachment; filename=employees_salary_1000_1500.xml')
        ->withHeader('Content-Transfer-Encoding', 'binary')
        ->write($this->employeeService->getBySalaryRangeAsXml(1000, 1500));
    }

  }

 ?>
