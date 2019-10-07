<?php

namespace Libro\Services;
//incluir model
use Libro\Model\LibroModelo;
//la mayoria de las funciones vienen del modelo, revisar bien los nombres y que coincidan.
class LibroService{

	private $libroModel;

	public function   __construct(){
		//el this de libro es la variable privada y el LibroModel() es el modelo 
		$this->libroModel = new LibroModelo();
	}

	//manda la variable al modelo para que  realice la consulta
	public function getAllLibro(){
		//libro es una variable calquiera, el this es el mismo q el constuctor y el getAllLibro es la función.
		$libros=$this->libroModel->getAllLibro();
		return $libros;
	}
	//función que va a agregar los datos en el parametro se indica lo que se va a recibir
	public function agregarLibro($formData){
		//se genera un array asosiativo
		$data = array(
			//campos de la base menos el id si es autoincrementable
			"nombre" => $formData['nombre'],
			"precio" => $formData['precio']
			);

		$libro = $this->libroModel->agregarLibro($data); 
		return $libro;
	}
	public function getLibroById($id){
		
		$libro = $this->libroModel->getLibroById($id);
		return $libro;
	}

	public function actualizarLibro($formData){
		// enviar solo los parametros que queremos modificar
		$data = array(
			"id" => $formData['id'],
			"nombre" => $formData['nombre'],
			"precio" => $formData['precio'],
			);
		//llamada al modelo
		$libro = $this->libroModel->actualizarLibro($data);
		return $libro;

	}
	public function eliminarLibro($id){
		$libro = $this->libroModel->eliminarLibro($id);
		return $libro;

	}

}