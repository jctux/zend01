<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        return new ViewModel();
    }

    public function holaAction() {
        return new ViewModel(array("texto" => "hola mundo Cha&i"));
    }

}
