<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

 function index()
 {
   $this->load->helper(array('form', 'url'));
   if (!isset($data['username'])) {
   	$data['username']='';
   }
   $this->load->view('inicio_view',$data);
 }

 function recuperar(){
 	redirect('recoverpassword/recuperar', 'refresh');
 }


 function cliente()
 {
 	 $this->load->helper(array('form', 'url'));
   if (!isset($data['username'])) {
   	$data['username']='';
   }
   $this->load->view('cliente_login_view',$data);
 }

}

?>