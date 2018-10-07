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

            // check for the method part from the url 

            if(isset($url[1])){
                //check if the method exist 
                if(method_exists($this->currentController,$url[1])){
                    $this->currentMethod = $url[1];
                    // now unset it in the array 
                    unset($url[1]); 
                }
            }
            
            // get params 
             $this->params = $url ? array_values($url) : [] ;

             //call a callback with array of params 

             call_user_func_array([$this->currentController,$this->currentMethod],$this->params);
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