<?php
/**
* @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
* @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
* @license   http://framework.zend.com/license/new-bsd New BSD License
*/

namespace Libro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Libro\Form\LibroForm;
use Libro\Model\Libro;

class LibroController extends AbstractActionController{
   protected $table;
   
   public function __construct($table){
           $this->table =$table;

   }
   public function indexAction(){
      
       $libros = $this->table->fetchAll();
       
       return new ViewModel(['libros' => $libros]);
   
}
    public function addAction(){
     
        $form = new LibroForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (! $request->isPost()) {
            return ['form' => $form];
        }

        $libro = new Libro();
        $form->setInputFilter($libro->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return ['form' => $form];
        }

        $libro->exchangeArray($form->getData());
        $this->table->saveLibro($libro);
        return $this->redirect()->toRoute('libro');

   }


   public function viewAction()
   {
       return new ViewModel();
   }

   public function deleteAction(){
      
     $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('libro');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $this->table->deleteLibro($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('libro');
        }

        return [
            'id'    => $id,
            'libro' => $this->table->getLibro($id),
        ];
    }

    public function editAction(){

      $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('libro', ['action' => 'add']);
        }

        // Retrieve the album with the specified id. Doing so raises
        // an exception if the album is not found, which should result
        // in redirecting to the landing page.
        try {
            $libro = $this->table->getLibro($id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('libro', ['action' => 'index']);
        }

        $form = new LibroForm();
        $form->bind($libro);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (! $request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($libro->getInputFilter());
        $form->setData($request->getPost());

        if (! $form->isValid()) {
            return $viewData;
        }

        $this->table->saveLibro($libro);

        // Redirect to album list
        return $this->redirect()->toRoute('libro', ['action' => 'index']);
   }

       
}