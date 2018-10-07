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
            $url = $this->getUrl();
            // look at the contoller at the first index 
                 // write the path from index file 
            if(file_exists('../app/controllers/' . ucwords($url[0]) .'.php')){
                // set as contoller
                 
                $this->currentController = ucwords($url[0]);
                // now unset it in the array
                unset($url[0]);
            }

            // require the contoller 
           
            require_once '../app/controllers/'. $this->currentController .'.php';
            $this->currentController = new $this->currentController;

        
        }


        public function getUrl(){
            if(isset($_GET['url'])){
                $url = rtrim($_GET['url'],'/');
                $url = filter_var($url,FILTER_SANITIZE_URL);
                $url = explode('/',$url);

                return $url;
            }
        }

    }
?>