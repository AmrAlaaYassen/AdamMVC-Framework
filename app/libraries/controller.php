<?php 

    /*  
        *Base Controller 
        *For Loading Models and Views 
    
    */ 


    class Controller { 


        // loading model 
        public function model ($model){
            // requilre model file 
            require_once '../app/models/'.$model.'.php';
            return new $model() ;
        }



        //loading view 
        public function view ($view,$data=[]){
            // $data [] dynamic data for the view 

            //check the view file 

            if (file_exists('../app/views/' . $view.'.php')){
                require_once '../app/views/' . $view.'.php' ;
            }else {
                // then view does not exist 
                die('view does not exist');
            }
        }




    }


    ?>