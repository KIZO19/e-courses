<?php
   class ControllerLogout{
      private $_view;

      public function __construct($url){
          if(isset($url) && count($url)>1)
             throw new Exception('Page intouvable');
             else
                $this->logout();
      }
       public function logout(){
           $this->_view=new View("logout");
           $this->_view->generate1();
       }
   }
