<?php

namespace  Libro\Form;

use Zend\Form\Element;
use Zend\Form\Form;

class LibroForm extends Form{

    public function __construct($name = null){
        // We will ignore the name provided to the constructor
        parent::__construct('libro');

                //mandamos a traer el metodo post

        $this->setAttributes(array(
            'method' => 'post',
            //identificacion del formulario
            'id'     => 'form'
        ));

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'nombre',
            'type' => 'text',
            'options' => [
                'label' => 'Nombre',
            ],
        ]);
        $this->add([
            'name' => 'precio',
            'type' => 'text',
            'options' => [
                'label' => 'Precio',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Agregar',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}