<?php

//namespace es como un paquete en java permite que si hay clases repetidas no aa conflicto

namespace Application\Controller; //llama componente por defecto de la configuraion de los controladores

use Zend\Mvc\Controller\AbstractActionController; //llamamos componente este controla los action contoller
use Zend\View\Model\ViewModel; //permite conectar los controladores con las vistas

class TrabajoController extends AbstractActionController {

    public function indexAction() {//la url recibe el parametro index y va buscar en el directorio 
        return new ViewModel(); //view application trabajo y con el nombre del archivo index
    }

    public function otroAction() {
        return new ViewModel();
    }

    public function recibeParametrosAction() {
        
        $saludo = "no te cases personita especial";
        $saludo2 = "la vida es especial";
        $list = array("Pedro", "Romina", "Chanita", "Silvana");
        return new ViewModel(array("saludo" => $saludo, "saludo2" => $saludo2, "nombres" => $list));
    }

    public function parametrosUrlAction() {
        $titulo = "valores por la url";
        //llamamos al metodo params despues a fromRoute que recupera los datos de la url
        //en este caso recuperaras el id
        $id = (int) $this->params()->fromRoute("id", null);
        $id2 = $this->params()->fromRoute("id2", null);
        $url = $this->getRequest()->getBaseUrl();

        return new ViewModel(array("titulo" => $titulo, "id" => $id, "id2" => $id2, "url" => $url));
    }

    //plugin redirect recarga la pagina http y pierde los datos
    public function redireccionarAction() {
        return $this->redirect()->toUrl($this->getRequest()->getBaseUrl() . "/application/trabajo/otro");
        }

   //plugin forward carga la vista y la inserta y no pierde las sessiones o parametros
    public function cargarvistaAction(){
        return $this->forward()->dispatch('Application\Controller\Trabajo',array("action"=>"otro"));
    }
    //plugin render
     public function conrenderAction(){
         
         //Render a la pagina application/trabajo/conrender.phtml
         $view = new ViewModel;
         return $view;
    }
    

}
