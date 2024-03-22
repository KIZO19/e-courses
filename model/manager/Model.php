<?php
    abstract class Model{
        private static $_bdd;
        private static function setBdd(){
        $timezone = "Africa/Cairo";
        date_default_timezone_set($timezone);
        self::$_bdd = new PDO('mysql:host=localhost; dbname=ecourses; charset=UTF8', 'root', '');
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        protected function getBdd(){
        if (self::$_bdd == null)
            self::setBdd();
        return self::$_bdd;
        }
        protected function getAll($procedure, $object)
        {
            try {
                $obj = [];
                $query = $this->getBdd()->prepare("CALL " . $procedure);
                $query->execute();
                while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                    $obj[] = new $object($data);
                }
                $query->closeCursor();
                return $obj;
            } catch (PDOException $ex) {
                throw new Exception('Error : ' + $ex);
            }
        }
        protected function getAllSelected($table, $obj){
            $var=[];
        $query = $this->getBdd()->prepare('SELECT * FROM ' . $table. '');
        $query->execute();
        while($donnee=$query->fetch(PDO::FETCH_ASSOC)){
            $var[] = new $obj($donnee);
        }
        return $var;
        }
    protected function getAllSelect_($table, $colonne){
        $var=[];
        $query = $this->getBdd()->prepare('SELECT * FROM ' . $table . '');
        $query->execute();
        while($donnee=$query->fetch(PDO::FETCH_ASSOC)){
            $var[] = $donnee;
        }
        return $var;
    }
    protected function insert($table, $obj){
        $var=[];
        $query=$this->getBdd()->prepare('INSERT INTO'.$table.'');
        $query->execute();
        while ($donnee=$query->fetch(PDO::FETCH_ASSOC)){
            $var[]=new $obj($donnee);
        }
    }
    protected function count($procedure, $field){
        $row = 0;
        try{
            $query=$this->getBdd()->prepare('CALL '.$procedure.'(?)');
            $query->execute(array($field));
            $row=$query->$query->fetchColumn();
            return (int)$row;
        }catch(PDOException $ex){
            throw new Exception('Error : ' . $ex->getMessage());
        }
    }
    protected function getOne($procedure, $id, $object){
        try{
            $obj=[];
            $query = $this->getBdd()->prepare("CALL " . $procedure . "(?)");
            $query->execute(array($id));
            while ($data=$query->fetch(PDO::FETCH_ASSOC)){
                $obj[] = new $object($data);
            }
            $query->closeCursor();
            return $obj;
        }catch(PDOException $ex){
            throw new Exception("Error " . $ex);
        }
    }
    protected function getTwo($procedure, $id,$colonne, $object)
    {
        try {
            $obj = [];
            $query = $this->getBdd()->prepare("CALL " . $procedure . " (?,?)");
            $query->execute(array($id,$colonne));
            while ($data = $query->fetch(PDO::FETCH_ASSOC)) {
                $obj[] = new $object($data);
            }
            $query->closeCursor();
            return $obj;
        } catch (PDOException $ex) {
            throw new Exception("Error " . $ex);
        }
    }
     protected abstract function createObj($action, $procedure, $object);
    }
?>