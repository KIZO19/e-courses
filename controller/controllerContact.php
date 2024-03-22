<?php
class ControllerContact{
    private $_view;
    public function __construct($url){
        if(isset($url) && count($url)>1)
            throw new Exception('page not found');
            else 
                $this->contact();
    }
    public function contact(){
        $this->_view = new View("contact");
        $this->_view->generate1();
    }
}