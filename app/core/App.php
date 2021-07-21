<?php

class App
{
  protected $controller = 'home';
  
  protected $default_method = 'index';

  protected $method;

  protected $params = [];


  public function __construct()
  {
    $url = $this->parseUrl();
    if (is_array($url))
    {
      // Check if the controller exists
      if (file_exists('../app/controllers/' . $url[0] . '.php'))
      {
        $this->controller = $url[0];
        unset($url[0]);
      }
  
      require_once '../app/controllers/' . $this->controller . '.php';
      $this->controller = new $this->controller;
      
      // Check if the method exists in the requested controller
      if (isset($url[1]) && method_exists($this->controller, $url[1]))
      {
        $this->method = $url[1];
        unset($url[1]);
      }
  
      // Check for parameters
      $this->params = $url ? array_values($url) : [];
      // call_user_func_array([$this->controller, $this->method ? $this->method : $this->default_method], $this->params);
    }
    else
    {
      require_once '../app/controllers/' . $this->controller . '.php';
      $this->controller = new $this->controller;
      // call_user_func_array([$this->controller, $this->default_method], $this->params);
    }
    call_user_func_array([$this->controller, $this->method ? $this->method : $this->default_method], $this->params);
  }

  protected function parseUrl()
  {
    if (isset($_GET['url']))
    {
      return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
    }
  }
}