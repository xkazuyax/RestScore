<?php
namespace App\Controller;

class MapsController extends AppController {
    public function initialize() {
        $this->autoRender =  true;
        $this->viewBuilder()->autoLayout(false);
    }

    public function index() {

    }
}

?>