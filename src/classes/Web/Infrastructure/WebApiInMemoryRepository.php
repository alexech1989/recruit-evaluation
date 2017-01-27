<?php

  namespace RecruIT\Evaluation\Web\Infrastructure;

  abstract class WebApiInMemoryRepository implements IInMemoryRepository
  {
    private $resourceUri;
    private $initCallback;
    protected $repository;

    protected function __construct($resourceUri, $initCallback)
    {
      $this->resourceUri = $resourceUri;
      $this->initCallback = $initCallback;
    }

    public function populateMemory()
    {
      if (is_callable($this->initCallback))
      {
        $json = json_decode(file_get_contents($this->resourceUri));
        $dump = call_user_func($this->initCallback, $json);
        $this->repository = $dump;
      }
      else
      {
        throw new \Exception('To populate the in-memory repository we need a valid callback');
      }
    }
  }

 ?>
