<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class PersonaController extends AbstractActionController {

    public function indexAction() {
        $view = new ViewModel();
        $this->layout("layout/persona");
        $this->layout()->saludo="hola como estas este es el año 2014...recuperación ";
        $this->layout()->title="Ciber Compras";
        return $view;
    }
    public function ajaxAction() {
        $view = new ViewModel();
        $view->setTerminal(true); //carga una vista sin layout ya que es un metodo ajax
        return $view;
    }
}
