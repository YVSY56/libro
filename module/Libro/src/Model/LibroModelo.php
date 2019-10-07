<?php

namespace Libro\Model;


use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\Feature;

class LibroModelo extends TableGateway {
 
  private $dbAdapter;

  public function   __construct(){
    $this->dbAdapter = \Zend\Db\TableGateway\Feature\GlobalAdapterFeature::getStaticAdapter();
    $this->table = 'libro';
    $this->featureSet = new Feature\FeatureSet();
    $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
    $this->initialize();
  }
  public function   getAllLibro(){
    //select from
    $select = $this->select();
    $libro = $select->toArray();
    //imprime un array
    //print_r($users);
    return $libro;
  }
  //Se crea funcion   que recibira arreglo
  public function  agregarLibro($data){
    //inserta el array desde el service
    $this->insert($data);
    return $data;
  }
  //
  public function getLibroById($id){

    $sql = new Sql($this->dbAdapter);
    $select = $this->dbAdapter->query("select * from libro where id=$id",Adapter::QUERY_MODE_EXECUTE);
    $result = $select->toArray();
    //imprime echo "<pre>"; print_r($result); exit;
    return $result[0];
  }
  public function actualizarLibro($data){
    // con esta linea mandamos el update
    $libro = $this->update($data, array("id"=>$data['id']));
    return $libro;
  }
  public function eliminarLibro($id){
    //"" se pone el nombre de la base de datos.
    $delete=$this->delete(array("id"=>$id));
           return $delete;
  }
}