<?php
class Pestana_configuracion_modelo extends CI_Model {

	public function __construct() {
		$this->load->database();
	}	

	public function get_info_usuario($email)
	{
		$this->db->select("idUsuario ,nombre, apellido, email, numeroReservasTotal, numeroReservasAsistidas");
		$this->db->from("usuario");
		$this->db->where("email", $email);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function get_numero_coloquios($email)
	{
		$this->db->select("numeroReservasAsistidas");
		$this->db->from("Usuario");
		$this->db->where("email", $email);
		$query = $this->db->get();
		return $query->result();
	}

	public function find_student_code($nombre) {
		$this->db->select("nombre");
		$this->db->from("Usuario");
		$this->db->where("nombre", $nombre);
		$query = $this->db->get();

	 if($query -> num_rows() == 1)
  	 {
     return true;
   	 } else {
   	 return false;
   	 }
	}

	public function add_new_user($nombre, $apellido, $email, $telefono, $direccion, $provincia, $ciudad, $password) {
		$this->load->helper('string');
 	    $aleatorio = random_string('alnum', 16);

		$data = array(
			   'nombre' => $nombre,
			   'apellido' => $apellido,
               'email' => $email,
               'telefono' => $telefono,
               'direccion' => $direccion,
               'provincia' => $provincia,
               'ciudad' => $ciudad,
               'contrasena' => MD5($password),
               'numeroReservasTotal' => 100,
               'numeroReservasAsistidas' => 8,
               'estaActivo' => 0
            );
		$this->db->insert('usuario', $data);



	}


	public function activate_account($activarCuenta) {
		$rows=$this->db->get_where('Usuario', array(
    "activarCuenta" => $activarCuenta
  ));  
		$data=array(
			"activarCuenta" => NULL,
			"estaActivo" => 1
			);

		$this->db->where("activarCuenta", $activarCuenta);
		$this->db->update("Usuario",$data);

		return $rows;

	}



	public function consulta_si_existe($activarCuenta)
{
  $rows=$this->db->get_where('Usuario', array(
    "activarCuenta" => $activarCuenta
  )); 
  $query = $this->db->get_where('Usuario', array('activarCuenta' => $activarCuenta));

  return $rows;
}



	public function get_activationURL($username) {
	$this->load->helper('string');
  if($username != FALSE) {
    $aleatorio = random_string('alnum', 16);
   	$this->db->where('email', $username); 

   	$data=array(
   		"activarCuenta"=>$aleatorio
   	);
   	$this->db->update("Usuario",$data);

    $query = $this->db->get_where('Usuario', array('email' => $username));
    
    return $query->row_array();
    
  }
  else {
    return 0;
  }
}


public function make_qr_for_user($codigoQR, $email, $ammount, $name, $cedula_ruc, $entrada) {
  $this->db->select('*');
  $this->db->from('giftcard');
  $this->db->where('email', $email);
  $query = $this->db->get();
  
  if (count($query->result()) == 1) {
  $this->db->query('UPDATE giftcard SET valor = (valor + '.$ammount.'), entrada='.$entrada.' where codigoQR = "'.$codigoQR.'"');
  } else if (count($query->result()) == 0) {
  $data = array (
    "codigoQR" => $codigoQR,
    "valor" => (float)$ammount,
    "email" => $email,
    "nombre" => $name,
    "cedula_ruc" => $cedula_ruc,
    "entrada" => $entrada
    );
  $this -> db -> insert("giftcard", $data);
  } else {
  	echo ("No se que paso");
  }
  return count($query->result());
}

public function consulta_si_qr_existe($codigo) 
{
  $this->db->select("*");
  $this->db->from("giftcard");
  $this->db->where("codigoQR", $codigo);
  $rows = $this->db->get();
  return $rows->result();

}


public function consulta_si_email_existe($email) 
{
  $this->db->select("*");
  $this->db->from("giftcard");
  $this->db->where("email", $email);
  $rows = $this->db->get();

   if($rows -> num_rows() == 1)
     {
     return true;
     } else {
     return false;
     }

}



public function consulta_si_tiene_entrada($email) 
{
  $this->db->select("entrada");
  $this->db->from("giftcard");
  $this->db->where("email", $email);
  $rows = $this->db->get();

   return $rows->result();

}


public function cobrar_giftcard($codigoQR, $monto, $entrada) 
{
	$query = $this->db->get_where('giftcard', array('codigoQR' => $codigoQR));
	foreach ($query->result() as $row)
{
    $valorInicial = $row->valor;
}

$montoFinal = $valorInicial - $monto;

if ($montoFinal < 0) {
	echo ("El monto a cobrar excede lo que tiene");
  exit();
} else {
	echo ("Pago realizado con exito");
}

	 $this->db->query('UPDATE giftcard SET valor = (valor - '.$monto.'), entrada='.$entrada.' where codigoQR = "'.$codigoQR.'" ');


  return $montoFinal;
	

}









	

	

}




?>