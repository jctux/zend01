<?php

namespace Application\Form;

use Zend\Captcha\AdapterInterface as CaptchaAdapter;
use Zend\Form\Element;
use Zend\Form\Form;
use Zend\Captcha;
use Zend\Form\Factory;

class PersonaForm extends Form {

    public function __construct($nombrex = null) {
        parent::__construct($nombrex);
        self::definicionElementosForm($this);
    }

    public static function definicionElementosForm($form) {
        $nombre = new Element('nombre');
        $nombre->setOptions(array('label' => 'Nombre: '));
        $nombre->setAttributes(array('type' => 'text', 'class' => 'input', 'placeholder' => 'Escribir nombre...','required'=>'required'));
        $form->add($nombre);


        $codigo = new Element('codigo');
        $codigo->setOptions(array('label' => 'Codigo: '));
        $codigo->setAttributes(array('type' => 'text', 'class' => 'input', 'placeholder' => 'Escribir Codigo...','required'=>'required'));
        $form->add($codigo);

        $email = new Element('email');
        $email->setOptions(array('label' => 'Email: '));
        $email->setAttributes(array('type' => 'email', 'class' => 'input', 'placeholder' => 'cero.one.x@gmail.com','required'=>'required'));
        $form->add($email);

        $enviar= new Element('enviar');
        $enviar->setAttributes(array('type' => 'submit','value'=>'send','class'=>'btncentrar'));
        $form->add($enviar);
    }

}

?>