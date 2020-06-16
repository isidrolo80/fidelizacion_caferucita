<?php 
	if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	class RecoverPassword extends CI_Controller {

		function __construct()
		{
		   parent::__construct();
		   $this->load->database();
		   $this->load->helper('url');
		   $this->load->helper('form');
		   $this->load->model('recoverpassword_model');
		   $this->load->library('form_validation');
		    require_once(APPPATH.'libraries/phpMailer/PHPMailerAutoload.php');
		}
		

		public function askUsername() {
		

			$this->load->view('Askusername_view');
		}

		public function show() {	
			$username=$_POST["username"];
			$this->form_validation->set_rules('username', 'Username', 'required|max_length[50]|callback_check_cliente',
				array('required' => '%s no puede estar vacio',
					  'max_length' => '%s puede tener maximo 50 caracteres')
			);

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('Askusername_view');
			} else {
			$this->load->model('recoverpassword_model');
			$recoverpassword = $this->recoverpassword_model->get_recoverPassword($username);
			if ($recoverpassword !=0)
			{
				$data['username'] = $recoverpassword['email'];
				$data['codigo'] = $recoverpassword['password'];
				$codigo = $data['codigo'];
				$email = $data['username'];
				$this->sendMail($codigo, $email);
				$this->load->view('recoverpassword_view',$data);
			}
		}

		}


		public function username_check($username) {
			$this->load->model('recoverpassword_model');
			$check_username = $this->recoverpassword_model->check_username($username);
			if ($check_username == TRUE)
			{
				return TRUE;
			}
			else {
				$this->form_validation->set_message('username_check', 'El usuario no existe');
				return FALSE;
			}
		}


        public function check_cliente($username) {
      $this->load->model('recoverpassword_model');
      $check_username = $this->recoverpassword_model->check_username_cliente($username);
      if ($check_username == TRUE)
      {
        return TRUE;
      }
      else {
        $this->form_validation->set_message('check_cliente', 'El usuario no existe');
        return FALSE;
      }
    }

			
	
	

		public function changePassword($recuperarContrasena='') {
			$this->load->model('recoverpassword_model');
			$cambiarContrasena = $this->recoverpassword_model->consulta_si_existe($recuperarContrasena);
			if ($cambiarContrasena->num_rows()>0) {
				$data = array('codigo' => $recuperarContrasena);
				$this->load->view('cambiarcontrasena_view',$data);
			} else {
				show_404();
			}	
			
		}


    public function asistio_a_cita($asistio='',$not='') {
      $this->load->model('recoverpassword_model');
      $asistioACita = $this->recoverpassword_model->consulta_si_existe_cita($asistio);

      if ($asistioACita->num_rows()>0) {
        $data = array('codigo' => $asistio
          );
        $this->confirmarAsistencia($asistio,$not);

      } else {
        show_404();
      } 
    }




        public function confirmarAsistencia($asistio, $not){
      $codigo = $asistio;
      $data = array('codigo' => $codigo);
      $this->load->model('recoverpassword_model');
      $cambiar = $this->recoverpassword_model->si_asistio($codigo, $not);
      
      if ($cambiar->num_rows()>0) {
        $this->load->view('se_cambio_la_contrasena_con_exito_view');
      } else {
        show_404();
      }
      }
      
    





		public function confirmarPassword(){
			$codigo = $_POST["codigo"];
			$data = array('codigo' => $codigo);
			$password = $_POST["password"];
			$password1 = $_POST["password1"];
			$this->form_validation->set_rules('password', 'Contrasena', 'required|min_length[8]|max_length[15]|callback_password_check',
				array('required' => '%s no puede estar vacio',
					  'min_length' => 'La %s debe tener por lo menos 8 caracteres',
					  'max_length' => 'La %s no puede tener mas de 15 caracteres')
				);
			$this->form_validation->set_rules('password1', 'Confirmar Contrasena', 'required|min_length[8]|max_length[15]|matches[password]',
				array('required' => '%s no puede estar vacio',
					  'min_length' => '%s debe tener por lo menos 8 caraceteres',
					  'max_length' => '%s no puede tener mas de 15 caracteres',
					  'matches' => 'Las contrasenas no coinciden')
				);

			if ($this->form_validation->run() == FALSE ) {
				$this->load->view('cambiarcontrasena_view',$data);
			} else {
				$this->load->model('recoverpassword_model');
			$cambiar = $this->recoverpassword_model->cambiar_contrasena($codigo,$password);
			if ($cambiar->num_rows()>0) {
				$this->load->view('se_cambio_la_contrasena_con_exito_view');
			} else {
				show_404();
			}
			}
			
		}


		 public function password_check($password)
		{
	 if (!preg_match("#[0-9]+#",$password)) {
        $this->form_validation->set_message('password_check', 'La contrasena debe tener por lo menos un numero');
        return FALSE;
    }
     elseif(!preg_match("#[A-Z]+#",$password)) {
        $this->form_validation->set_message('password_check', 'La contrasena debe tener por lo menos una letra mayuscula');
        return FALSE;
    }
     elseif(!preg_match("#[a-z]+#",$password)) {
          $this->form_validation->set_message('password_check', 'La contrasena debe tener por lo menos una letra minuscula');
          return FALSE;
    } else
          {
          return TRUE;
          }
    	}


    		




		public function sendMail($codigo, $email)
		{


$mensaje = (
'<!doctype html>
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Simple Transactional Email</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }

      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0; 
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; }

      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }

      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */

      .body {
        background-color: #f6f6f6;
        width: 100%; }

      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; }

      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }

      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #fff;
        border-radius: 3px;
        width: 100%; }

      .wrapper {
        box-sizing: border-box;
        padding: 20px; }

      .footer {
        clear: both;
        padding-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; }

      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        Margin-bottom: 30px; }

      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }

      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        Margin-bottom: 15px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; }

      a {
        color: #3498db;
        text-decoration: underline; }

      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }

      .btn-primary table td {
        background-color: #3498db; }

      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; }

      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }

      .first {
        margin-top: 0; }

      .align-center {
        text-align: center; }

      .align-right {
        text-align: right; }

      .align-left {
        text-align: left; }

      .clear {
        clear: both; }

      .mt0 {
        margin-top: 0; }

      .mb0 {
        margin-bottom: 0; }

      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }

      .powered-by a {
        text-decoration: none; }

      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }

      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
        table[class=body] .article {
          padding: 10px !important; }
        table[class=body] .content {
          padding: 0 !important; }
        table[class=body] .container {
          padding: 0 !important;
          width: 100% !important; }
        table[class=body] .main {
          border-left-width: 0 !important;
          border-radius: 0 !important;
          border-right-width: 0 !important; }
        table[class=body] .btn table {
          width: 100% !important; }
        table[class=body] .btn a {
          width: 100% !important; }
        table[class=body] .img-responsive {
          height: auto !important;
          max-width: 100% !important;
          width: auto !important; }}

      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; } 
        .btn-primary table td:hover {
          background-color: #34495e !important; }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; } }

    </style>
  </head>
  <body class="">
    <table border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">

            <!-- START CENTERED WHITE CONTAINER -->
            <span class="preheader">Este es un texto indicador, HTML no esta cargando correctamente</span>
            <table class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <img src="http://caferucita.com/giftcards/images/logo.png" height="auto" width="200">
                        <br><br>
                        <p>Hola,</p>
                        <p>Puedes cambiar tu contrasena haciendo click en el siguiente boton</p>
                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>
                                      <td> <a href="'.base_url().'index.php/recoverpassword/changepassword/'.$codigo.'" target="_blank">Cambiar mi Contrasena</a> </td>
                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p>En caso de tener algun problema, no duden en contactarnos en Pilisimas.com</p>
              
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

            <!-- END MAIN CONTENT AREA -->
            </table>

            <!-- START FOOTER -->
            <div class="footer">
              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">
                    <span class="apple-link">Enviado con &hearts; desde Quito, Ecuador</span>
                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
                    Contacto: <a href="http://pilisimas.com/#contactanos">Pilisimas.com</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->
            
          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>
'
	);



    $this->load->library('mailgun');
    $this->mailgun
        ->to($email)
        ->from('This is the name shown in the from section <hello@mycompany.com>')
        ->subject('Recupera tu contrasena')
        ->message($mensaje)
        ->send();







		}
	

	}

?>