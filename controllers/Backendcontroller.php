<?php

class BackendController extends Controller{
  function index(){
    $this->view("Backend/index");
  }



  function members(){
    $this->view("Backend/members");
  }
}
?>