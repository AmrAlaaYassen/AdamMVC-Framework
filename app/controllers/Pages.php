<?php 


    class Pages extends Controller{

        public function __construct(){
            
        }


        public function about (){
            $this->view('pages/about');
        }

        public function index (){
            $this->view('pages/indexView');
        }
    }
?>