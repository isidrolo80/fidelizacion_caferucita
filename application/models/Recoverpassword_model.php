<?php

class Recoverpassword_model extends CI_Model {


public function __construct()	{
  $this->load->database(); 
}


public function check_username($username) {
  $this->db->select('email');
  $this->db->from('usuarios');
  $this->db->where('email', $username);
  $query = $this->db->get();
  //print_r($query->result());

   if($query -> num_rows() == 1)
   {
     return true;
   }
   else
   {
     return false;
   }

}


public function check_username_cliente($username) {
  $this->db->select('email');
  $this->db->from('giftcard');
  $this->db->where('email', $username);
  $query = $this->db->get();
  //print_r($query->result());

   if($query -> num_rows() == 1)
   {
     return true;
   }
   else
   {
     return false;
   }

}


public function check_activation($username) {
  $this->db->select('estaActivo');
  $this->db->from('usuario');
  $this->db->where('email', $username);
  $this->db->where('estaActivo', 1);
  $query = $this->db->get();
  print_r($query->result());

   if($query -> num_rows() == 1)
   {
     return true;
   }
   else
   {
     return false;
   }

}


public function get_recoverPassword($username) {
	$this->load->helper('string');
  if($username != FALSE) {
    $aleatorio = random_string('alnum', 16);
   	$this->db->where('email', $username); 

   	$data=array(
   		"password"=>$aleatorio
   	);
   	$this->db->update("giftcard",$data);

    $query = $this->db->get_where('giftcard', array('email' => $username));
    
    return $query->row_array();
    
  }
  else {
    return 0;
  }
}

public function consulta_si_existe($codigo)
{
  $rows=$this->db->get_where('giftcard', array(
    "password" => $codigo
  )); 
  $query = $this->db->get_where('giftcard', array('password' => $codigo));

  return $rows;
}

public function cambiar_contrasena($codigo, $password)
{
  $rows=$this->db->get_where('giftcard', array(
    "password" => $codigo
  ));  
  $data=array(
    "password"=>md5($password)
    );
  $this->db->where("password",$codigo);
  $this->db->update("giftcard",$data);


  return $rows;

}


}

?>