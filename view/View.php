
<?php
class View
{
    private $_file;
    private $_t;
    function __construct($action){
        //Verification de l'exisatance des fichiers 
        if (file_exists('view/pages/' . strtolower($action) . '.php')) {
            $this->_file = 'view/pages/' . strtolower($action) . '.php';
        } else
            $this->_file = 'view/admin/' . strtolower($action) . '.php';
    }
    //Fonction pour recuperer les pages sans charger les donnees depuis la bd
    private function generateFile1($file)
    {
        if (file_exists($file)) {
            //Mise en tempo avec ob_start();
            ob_start();
            require $file;
            //Arret de la temporisation avec ob_get_clean()
            return ob_get_clean();
        } else
            throw new Exception('Fichier ' . $file . ' introuvable.');
    }
  
    //Generation de la view Avec donnees
    public function generate($data)
    {
        $content = $this->generateFile1($this->_file, $data);
        $view = $this->generateFile1('view/template.php', array('t' => $this->_t, 'content' => $content));
        echo $view;
    }

    //Generation de la view sans donnees
    public function generate1()
    {
        $content = $this->generateFile1($this->_file);
        echo $content;
    }
}
    
