<?php

namespace Application\Model\Entity;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;

class Usuario extends TableGateway {

    public function __construct(Adapter $adapter = null, $databaseSchema = null, ResulSet $selectResultPrototype = null) {

        return parent::__construct('usuario', $adapter, $databaseSchema, $selectResultPrototype);
    }

    public function getUsuarios(){
        $resultSet = $this->select();
        
        return $resultSet;
    }
    
    public function getUsuarioId($id){
        $id = (int)$id;
        $rowset = $this->select(array('id'=>$id));
        $row = $rowset->current();
        if (!$row) {
            throw new Exception('no hay registros asociados al usuario: '.$id);
        }
        
        return $row;
    }
}

?>
