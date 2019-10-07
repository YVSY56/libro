<?php
/**
* @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
* @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
* @license   http://framework.zend.com/license/new-bsd New BSD License
*/

namespace Libro\Controller;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Libro\Services\LibroService;
use Libro\Form\LibroForm;


class LibroController extends AbstractActionController{
   
   protected $table;
   
   public function __construct(){
           $this->table =new LibroService();

   }
   public function indexAction(){
      
       $libros = $this->table->getAllLibro();
       
       return new ViewModel(['libros' => $libros]);
   
}
    public function addAction(){
     
        $form = new LibroForm();
        if($this->getRequest()->isPost()){
           $formData =$this->getRequest()->getPost();
           $libro=$this->table->agregarLibro($formData);
           if($libro){
               $this->redirect()->toUrl($this->getRequest()->getBAseUrl().'/libro');

           }
        }
       return array('form'=>$form); 
   }


   public function viewAction()
   {
       return new ViewModel();
   }

   public function deleteAction(){

    $id = $this->params()->fromRoute("id");
    $libro = $this->table->eliminarLibro($id);
    //redirecciona al index del listado.
    return $this->redirect()->toUrl($this->getRequest()->getBaseUrl().'/libro/');
    }

    public function editAction(){

    $form = new LibroForm();
    #recupera id
    $id = $this->params()->fromRoute("id");
    //echo $id_user; exit;
    $libro = $this->table->getLibroById($id);
    //carga los valores al formulario
    $form-> setData($libro);
    //para que nos muestre el formulario
    if ($this->getRequest()->isPost()) {
      # recuperar datos
      $formData = $this->getRequest()->getPost();
      //imprime
      //echo "<pre>"; print_r($formData);exit;
      $libro = $this->table->actualizarLibro($formData);
        if ($libro) {
          # valida que la variable tenga algo para regresarlo.
          $this->redirect()->toUrl($this->getRequest()->getBAseUrl().'/libro');
        }
    }
    return array('form'=>$form);
   }
       
}