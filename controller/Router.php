<?php
require_once("view/view.php");
class Router{
    private $_ctrl, $_view;
    public function routeReq(){
        try{
            spl_autoload_register(function($class){
                $fileManager="model/manager/" . $class . ".php";
                $fileObject="model/object/" . $class . ".php";
                if(file_exists($fileManager)){
                    require_once($fileManager);
                }elseif($fileObject){
                    require_once($fileObject);
                }else{
                    echo "Fichier" . $class .".php n/'existe pas";
                }
            });
            $url[]="";
            // function parceUrl(){
            //     if(isset($_GET['url'])){
            //         return $url=explode('/', filter_var(rtrim($_GET['url'], '/', FILTER_SANITIZE_URL)));
            //     }
            // }
            if(isset($_GET['url'])){
                
                $url=explode('?', filter_var($_GET['url']), FILTER_SANITIZE_URL);
                $controller=ucfirst(strtolower($url[0]));
                $controllerClass="Controller".$controller;
                $controllerFiles="controller/" . $controllerClass . ".php";
                if(file_exists($controllerFiles)){
                    require_once($controllerFiles);
                    $this->_ctrl=new $controllerClass($url);
                }else{
                    throw new Exception('Page Introuvanle !');
                }
            }else{
                require_once ("controller/ControllerHome.php");
                $this->_ctrl=new ControllerHome($url);
            }
        
        }catch(Exception $ex){
            $errorMsg = $ex->getMessage();
            $this->_view = new View("error");
            $this->_view->generate(array("errorMsg" => $errorMsg));
        }
    }
}
