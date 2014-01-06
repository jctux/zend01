<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\Log\Formatter\Simple;
use Application\Model\Entity\Cliente;
use Application\Form\PersonaForm;

class PersonaController extends AbstractActionController {

    public function __construct() {

        date_default_timezone_set("America/Lima");
        $logger = new Logger();
        $writer = new Stream('C:\log\zend01\log_programzend' . date("_Y_m_d") . '.log');
        $formatter = new Simple(date('Y-m-d H:i:s') . ' %priorityName% (%priority%): %message%');
        $writer->setFormatter($formatter);
        $logger->addWriter($writer);

        $logger->debug("esto es un debug");
    }

    public function indexAction() {
        $view = new ViewModel();
        $this->layout("layout/persona");
        $this->layout()->saludo = "hola como estas este es el año 2014...recuperación ";
        $this->layout()->title = "Ciber Compras";
        return $view;
    }

    public function ajaxAction() {
        $view = new ViewModel();
        $view->setTerminal(true); //carga una vista sin layout ya que es un metodo ajax
        return $view;
    }

    public function clienteAction() {
        $listc = new \Zend\Stdlib\ArrayObject();
        $cliente1 = new Cliente();
        $cliente2 = new Cliente();

        $cliente1->setNombre("jose antonio");
        $cliente1->setCodigo("0889883553");

        $cliente2->setNombre("Chanita Gad Bella");
        $cliente2->setCodigo("5576889");

        $listc->append($cliente1);
        $listc->append($cliente2);

        return new ViewModel((array("listc" => $listc)));
    }

    public function formulariopersonaAction() {
        $form = new PersonaForm("x");
        return new ViewModel((array("personaform" => $form)));
    }

    public function recibeAction() {
        $c1 = new Cliente();
        $c1->setNombre($this->request->getPost()->nombre);
        $c1->setCodigo($this->request->getPost()->codigo);
        $c1->setEmail($this->request->getPost()->email);

        return new ViewModel(array('cliente'=>$c1));
    }

}
