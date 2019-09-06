<?php

namespace  Libro\Form;

use Zend\Form\Form;

class LibroForm extends Form{

    public function __construct($name = null){
        // We will ignore the name provided to the constructor
        parent::__construct('libro');


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
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}