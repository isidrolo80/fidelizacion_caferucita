<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

 function __construct()
 {
   parent::__construct();
 }

 function index()
 {
   $this->load->helper(array('form', 'url'));
   $this->load->view('inicio_view');
 }

 function recuperar(){
 	redirect('recoverpassword/recuperar', 'refresh');
 }

}

?>