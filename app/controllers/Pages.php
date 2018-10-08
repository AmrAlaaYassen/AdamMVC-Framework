<?php 


    class Pages extends Controller{

        public function __construct(){
           
        }


        public function about (){
            $this->view('pages/about');
        }

        public function index (){
            
           
           $data = [
               'title' =>'welcome'
           ];
           $this->view('pages/indexView',$data);

        }
    }
?>