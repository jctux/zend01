<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\Log\Formatter\Simple;
use Application\Model\Entity\Cliente;

class PersonaController extends AbstractActionController {

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
        $cliente1->setNombre("jose antonio");
        $cliente1->setCodigo("0889883553");

        $cliente2 = new Cliente();
        $cliente2->setNombre("Chanita Gad Bella");
        $cliente2->setCodigo("5576889");

        $listc->append($cliente1);
        $listc->append($cliente2);
//        
//        $session = new Container('base');
//        $session->offsetSet('email', "jxtux");

        date_default_timezone_set("America/Lima");
        $logger = new Logger();
        $writer = new Stream('C:\log\zend01\log_programzend' . date("_Y_m_d") . '.log');
        $formatter = new Simple(date('Y-m-d H:i:s') . ' %priorityName% (%priority%): %message%');
        $writer->setFormatter($formatter);
        $logger->addWriter($writer);

        $logger->emerg("esto es una emergen");
        $logger->alert("esto es una alerta");
        $logger->crit("esto es algo critico");
        $logger->err("esto es un error");
        $logger->warn("esto es un warning");
        $logger->notice("esto es una noticia");
        $logger->info('esta es una info');
        $logger->debug("esto es un debug");

        return new ViewModel((array("listc" => $listc)));
    }

}
