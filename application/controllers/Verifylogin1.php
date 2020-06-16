<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin1 extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('user','',TRUE);
 }

 function verifylogin1() {
  parent::CI_Controller();


 }

 function index()
 {
   //This method will have the credentials validation
   $this->load->library('form_validation');
   $this->form_validation->set_rules('username', 'Username', 'trim|required|callback_username_check',
    array('required' => '%s no puede estar vacio')
    );
   $this->form_validation->set_rules('password', 'Password', 'trim|required|callback_check_database',
    array('required' => '%s no puede estar vacio')
    );


  $username = $this->input->post('username');



   if($this->form_validation->run() == FALSE)
   {
    $data['username'] = $username;
     //Field validation failed.  User redirected to login page
     $this->load->view('cliente_login_view',$data);
   }
   else
   {
     //Go to private area
     redirect('vendedor/index_cliente', 'refresh');
   }

 }

 function username_check($username) {
  

      $this->load->model('recoverpassword_model');
      $check_username = $this->recoverpassword_model->check_username_cliente($username);
      if ($check_username == TRUE)
      {
        return TRUE;
      }
      else {
        $this->form_validation->set_message('username_check', 'El usuario no existe');
        return FALSE;
      }
    }




 function check_database($password)
 {
   //Field validation succeeded.  Validate against database
   $username = $this->input->post('username');

   //query the database
   $result = $this->user->login_cliente($username, $password);


   if($result)
   {
     $sess_array = array();
     foreach($result as $row)
     {
       $sess_array = array(
         'valor' => $row->valor,
         'email' => $row->email,
         'codigoQR' => $row->codigoQR,
         'entrada' => $row->entrada,
         'nombre' => $row->nombre,
         'cedula_ruc' => $row->cedula_ruc
       );

    


       //$this->session->set_userdata($sess_array);
       ini_set('session.cookie_lifetime', 86900400);
       ini_set('session.gc_maxlifetime', 86900400);
       //echo "ok";
       session_start();
       $_SESSION["giftcard"]=$sess_array;
       }
     return TRUE;
 }
   else
   {
     $this->form_validation->set_message('check_database', 'Contrasena Incorrecta');
     return false;
   }
 }
}
?>