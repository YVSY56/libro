<?php
   namespace Libro\Model;
   use RuntimeException;
   use Zend\Db\TableGateway\TableGatewayInterface;
   
   class LibroTable{
       private $tableGateway;
   
       public function __construct(TableGatewayInterface $tableGateway){
           $this->tableGateway = $tableGateway;
       }
   
       public function fetchAll(){
           return $this->tableGateway->select();
       }
   
       public function getLibro($id){
           $id = (int) $id;
           $rowset = $this->tableGateway->select(['id' => $id]);
           $row = $rowset->current();
           if (! $row) {
               throw new RuntimeException(sprintf(
                   'Could not find row with identifier %d',
                   $id
               ));
           }
   
           return $row;
       }
   
       public function saveLibro(Libro $libro){
           $data = [
               'nombre' => $libro->nombre,
               'precio'  => $libro->precio,
                ];
   
           $id = (int) $libro->id;
   
           if ($id === 0) {
               $this->tableGateway->insert($data);
               return;
           }
   
           try {
               $this->getLibro($id);
           } catch (RuntimeException $e) {
               throw new RuntimeException(sprintf(
                   'Cannot update post with identifier %d; does not exist',
                   $id
               ));
           }
   
           $this->tableGateway->update($data, ['id' => $id]);
       }
   
       public function deleteLibro($id)
       {
           $this->tableGateway->delete(['id' => (int) $id]);
       }
   }
?>