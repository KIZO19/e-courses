<?php
   class ControllerHome{
      private $_view;

      public function __construct($url){
          if(isset($url) && count($url)>1)
             throw new Exception('Page intouvable');
             else
                $this->home();
      }
       public function home(){
           $this->_view=new View("home");
           $this->_view->generate1();
       }
   }
