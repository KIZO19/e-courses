<?php
   class ControllerLogin{
      private $_view;

      public function __construct($url){
          if(isset($url) && count($url)>1)
             throw new Exception('Page intouvable');
             else
                $this->login();
      }
       public function login(){
           $this->_view=new View("login");
           $this->_view->generate1();
       }
   }
