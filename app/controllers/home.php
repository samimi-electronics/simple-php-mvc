<?php

class Home extends Controller
{
  public function Index($first_name = '', $last_name = '')
  {
    $user = $this->model('User');
    $user->first_name = $first_name;
    $user->last_name = $last_name;
    $this->view('home/index', ['first_name' => $user->first_name, 'last_name' => $user->last_name]);
  }
}