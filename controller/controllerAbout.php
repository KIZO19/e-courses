<?php
class ControllerAbout{
    private $_view;
    public function __construct($url){
        if(isset($url) && count($url)>1)
            throw new Exception('page not found');
            else 
                $this->about();
    }
    public function about(){
        $this->_view = new View("about");
        $this->_view->generate1();
    }
}