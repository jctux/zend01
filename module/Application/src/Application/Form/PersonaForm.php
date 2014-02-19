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
        //input text
        $nombre = new Element('nombre');
        $nombre->setLabel('Nombre: ');
        $nombre->setAttributes(array('type' => 'text', 'id' => 'nombre', 'class' => 'input', 'placeholder' => 'Escribir nombre...', 'required' => 'required'));
        $form->add($nombre);


        $codigo = new Element('codigo');
        $codigo->setLabel('Codigo: ');
        $codigo->setAttributes(array('type' => 'text', 'id' => 'codigo', 'class' => 'input', 'placeholder' => 'Escribir Codigo...', 'required' => 'required'));
        $form->add($codigo);

        //input mail
        $email = new Element('email');
        $email->setLabel('Email: ');
        $email->setAttributes(array('type' => 'email', 'id' => 'email', 'class' => 'input', 'placeholder' => 'cero.one.x@gmail.com', 'required' => 'required'));
        $form->add($email);

        $enviar = new Element('enviar');
        $enviar->setAttributes(array('type' => 'submit', 'value' => 'send', 'class' => 'btncentrar'));
        $form->add($enviar);

        // File Input
        $file = new Element('archivo_img');
        $file->setLabel('Sube archivo: ');
        $file->setAttributes(array('type' => 'file', 'value' => 'seleccione', 'accept' => 'image/*'));
        $form->add($file);

        //radio button
        $radio = new Element\Radio('genero');
        $radio->setLabel('Cual es tu sexo ?: ');
        $radio->setAttributes(array('value' => '1', 'id' => 'genero'));
        $radio->setValueOptions(array(
            '0' => ' Mujer ',
            '1' => ' Hombre',
        ));

        $form->add($radio);

        //checkbox
        $language = new Element\MultiCheckbox('language');
        $language->setLabel('What programming language you like ?: ');
        $language->setAttributes(array('id' => 'language'));
        $language->setValueOptions(array(
            '0' => ' Java ',
            '1' => ' Php ',
            '2' => ' JavaScript '
        ));
        $form->add($language);

        //select
        $languages = new Element\Select('languages');
        $languages->setLabel('What language you like? ');
        $languages->setAttributes(array('id' => 'languages','value'=>'2'));
        $languages->setEmptyOption("Seleccione...");
        $languages->setValueOptions(array(
            '0' => 'French',
            '1' => 'English',
            '2' => 'Japanese',
            '3' => 'Chinese óó',
        ));
        $form->add($languages);


        $fecha = new Element('fecha');
        $fecha->setLabel('Fecha Ingreso: ');
        $fecha->setAttributes(array('type' => 'date', 'id' => 'fecha', 'class' => 'input', 'placeholder' => date('Y-m-d'), 'required' => 'required', 'min' => '2014-01-01', 'max' => '2020-01-01', 'step' => '1',));
        $fecha->setOptions(array('format' => 'Y-m-d'));
        $form->add($fecha);

        $textarea = new Element\Textarea('textarea');
        $textarea->setLabel('Description: ');
        $form->add($textarea);
    }

}

?>