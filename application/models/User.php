<?php
Class User extends CI_Model
{
 function login($username, $password)
 {
   $this -> db -> select('email,idusuarios, tipoUsuario');
   $this -> db -> from('usuarios');
   $this -> db -> where('email', $username);
   $this -> db -> where('contrasena', MD5($password));
   $this -> db -> limit(1);

   $query = $this -> db -> get();
   // print_r($query->result());
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else if ($query -> num_rows() == 0)
   {
     return false;
   }
 }






  function login_cliente($username, $password)
 {
   $this -> db -> select('email,valor,codigoQR,entrada,nombre,cedula_ruc');
   $this -> db -> from('giftcard');
   $this -> db -> where('email', $username);
   $this -> db -> where('password', MD5($password));
   $this -> db -> limit(1);

   $query = $this -> db -> get();
   // print_r($query->result());
   if($query -> num_rows() == 1)
   {
     return $query->result();
   }
   else if ($query -> num_rows() == 0)
   {
     return false;
   }
 }
 
 


}



?>