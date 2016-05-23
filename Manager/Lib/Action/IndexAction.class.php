<?php
class IndexAction extends CommonAction {
    public function index(){
    	LocationUrl("http://".$_SERVER['HTTP_HOST']."/".APP_URL."/login");
    }
    

}