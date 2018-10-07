<?php 
    /*
     *App Core Class 
     *Creates URL and Loads Core Contoller
     *URL FORMAT : /controller/method/params
    */ 

    class Core {
        protected $currentController = 'Pages';
        protected $currentMethod = 'index';
        protected $params = [];


        public function __construct(){
            $this->getUrl();
        }


        public function getUrl(){
            echo $_GET['url'];
        }

    }
?>