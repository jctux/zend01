<?php

namespace Pagos\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController {

    public function indexAction() {
        return new ViewModel();
    }
    public function newModuloAction() {
        return new ViewModel();
    }

}
