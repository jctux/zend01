<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\Log\Formatter\Simple;
use Application\Model\Entity\Cliente;
use Application\Model\Entity\Usuario;
use Application\Form\PersonaForm;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;

class PersonaController extends AbstractActionController {

    public $dbAdapter;

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

        return new ViewModel(array('cliente' => $c1));
    }

    //esto debe estar en el modelo
    public function dataClienteAction() {
        $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter'); // Zend\Db\Adapter es el definido en local.php
        $result = $this->dbAdapter->query('select * from cliente', Adapter::QUERY_MODE_EXECUTE); //QUERY_MODE_EXECUTE genera la ejecucion atravez del metodo query
        //print_r($this->dbAdapter);

        return new ViewModel(array('titulo' => 'Conectandose...... via resultSet', 'datos' => $result->toArray()));
    }

    //esto debe estar en el modelo
    public function datasqlClienteAction() {
        $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter'); // Zend\Db\Adapter es el definido en local.php
        $sql = new Sql($this->dbAdapter);
        $select = $sql->select();
        $select->from('cliente');
        $selectString = $sql->getSqlStringForSqlObject($select);
        $result = $this->dbAdapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);

        return new ViewModel(array('titulo' => 'Conectandose...... via Sql getSqlStringForSqlObject', 'datos' => $result->toArray()));
    }

    public function datasqlstamentAction() {
        $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter'); // Zend\Db\Adapter es el definido en local.php

        $sql = new Sql($this->dbAdapter);
        $select = $sql->select();
        $select->columns(array('i' => 'id', 'nom' => 'nombre'));
        $select->from(array('c' => 'cliente'));
        $select->where(array(//'c.id = 0',
            //'c.nombre= chanita mi gad bella',
            //'c.nombre'=>null,
            new \Zend\Db\Sql\Predicate\IsNotNull('c.nombre'),
            'c.id' => array(1, 2, 3), //esto es un in
            'c.id > 0',
            'c.nombre is not null',
            "c.nombre = 'chanita mi gad bella'"
        ));
        $select->offset(0);
        $select->limit(3);
        $select->order('c.nombre asc, c.id desc');


        $statement = $sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();

        return new ViewModel(array('titulo' => 'Conectandose...... via Sql y prepareStamentSqlObject', 'datos' => $result));
    }

    public function tableGatewayUsuarioAction() {
        $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter'); // Zend\Db\Adapter es el definido en local.php
        $u = new Usuario( $this->dbAdapter);
        
        
        return new ViewModel(array('titulo' => 'Conectandose...... via TableGateway','datos'=>$u->getUsuarios()));
    }

     public function verAction() {
        $this->dbAdapter = $this->getServiceLocator()->get('Zend\Db\Adapter'); // Zend\Db\Adapter es el definido en local.php
        $u = new Usuario( $this->dbAdapter);
        $id = (int)$this->params()->fromRoute('id',0);
 
        return new ViewModel(array('titulo' => 'Mostrando datos del usuario','datos'=>$u->getUsuarioId($id)));
    }
}
