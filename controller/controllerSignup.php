<?php
class ControllerSignup{
    private $_view;
    public function __construct($url){
        if(isset($url) && count($url)>1)
            throw new Exception('page not found');
            else 
                $this->signup();
    }
    public function signup(){
        $this->_view = new View("signup");
        $this->_view->generate1();
    }
}