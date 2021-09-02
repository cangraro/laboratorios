<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Menu extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('captcha');
    }

    public function createWord() {
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $word = '';
        for ($a = 0; $a <= 5; $a++) {
            $b = rand(0, strlen($chars) - 1);
            $word .= $chars[$b];
        }

        return $word;
    }

    public function index() {
        //  $this->ion_auth->register('administrator', '1234', 'admin@admin.com', array( 'first_name' => 'administrador', 'last_name' => 'epymes' ), array('1') );
        //   print_r($this->ion_auth->user()->row());
        if (!$this->ion_auth->logged_in()) {
            // $this->login();
            // $this->session->set_flashdata('error', 'Debes identificarte para usar este componente');
            $this->load->view('template/login_new');
        } else {
            //lo redireccionamos al menu ppal
            $this->menu_ppal();
        }
    }

    public function sidebar() {
        $user = $this->ion_auth->user()->row();
        //traer los permisos de vista del usuario
        $this->load->model('permisos_model');
        $data['categorias'] = $this->permisos_model->obtener_permisos_menu();
        $this->load->view('template/sidebar', $data);
    }

    public function login() {
        $this->form_validation->set_rules('usuario', 'usuario', 'required');
        $this->form_validation->set_rules('clave', 'clave', 'required');
        $datos['usuario'] = $this->input->post('usuario');
        $datos['clave'] = $this->input->post('clave');


        if ($this->ion_auth->is_max_login_attempts_exceeded($datos['usuario'])) {

            $this->session->set_flashdata('error', 'has intentado muchas veces, olvidaste tu clave?');

            redirect('menu/index', 'refresh');
            // print_r($datos);
            return;
        }


        if ($this->ion_auth->login($datos['usuario'], $datos['clave'])) {
            $identity = $this->session->userdata('identity');
            $this->ion_auth->clear_login_attempts($identity);
            $messages = $this->ion_auth->messages();

            if ($this->ion_auth->logged_in()) {
                log_message('debug', 'sigue logueado');
            }
            $newdata = array(
                'nombre' => mb_convert_case($this->ion_auth->user()->row()->username, MB_CASE_TITLE, "UTF-8"),
                'logged_in' => TRUE
            );

            $this->session->set_userdata($newdata);
            // $this->session->set_flashdata('message', $this->ion_auth->messages());
            // redirect('menu/index');
            redirect('menu/index', 'refresh');
            return;
        } else {
            $messages = $this->ion_auth->messages();

            $this->session->set_flashdata('error', 'Clave o Usuario Incorrecto');
            // $this->session->set_flashdata('error', $this->ion_auth->messages());


            redirect('menu/index', 'refresh');
            return;
            // redirect('/menu'); //use redirects instead of loading views for compatibility with MY_Controller libraries
        }
    }

    public function actualizacion() {

        $this->load->view('template/mantenimiento');
    }

    public function logout() {
        //log the user out
        $logout = $this->ion_auth->logout();

        //redirect them to the login page
        $this->session->set_flashdata('message', $this->ion_auth->messages());
        redirect('/', 'refresh');
    }

    public function cambiar_clave() {
        $this->form_validation->set_rules('clave_ant', 'Clave Anterior', 'required');
        $this->form_validation->set_rules('clave', 'clave', 'required|min_length[8]|matches[repetir_clave]|trim|xss_clean');
        $this->form_validation->set_rules('repetir_clave', 'repetir clave', 'required|min_length[8]|trim|xss_clean|matches[clave]');
        $this->data['nombre'] = mb_convert_case($this->ion_auth->user()->row()->first_name, MB_CASE_TITLE, "UTF-8");
        if ($this->form_validation->run() == false) {
            $this->data['template'] = 'user/cambiar_clave';
            $this->load->view('template/template', $this->data);
            return;
        } else {
            $clave_ant = $this->input->post('clave_ant');
            $clave = $this->input->post('clave');
            $identity = $this->session->userdata('identity');
            $change = $this->ion_auth->change_password($identity, $clave_ant, $clave);
            if ($change) {
                $datos = array('ultimo_cambio_clave' => date("Y-m-d H:i:s"));
                $this->ion_auth->update($this->session->userdata('user_id'), $datos);
                $this->ion_auth->clear_login_attempts($identity);
                $this->session->set_flashdata('message', 'Clave Actualizada Correctamente!');
                redirect('', 'refresh');
                return;
            } else {
                $this->data['error'] = 'La clave anterior no es correcta!';
                $this->data['template'] = 'user/cambiar_clave';
                $this->load->view('template/template', $this->data);
                return;
            }
        }
    }

    public function recuperar_clave() {
        $this->form_validation->set_rules('usuario', "Usuario", 'required');
        $this->form_validation->set_rules('captcha', "Captcha", 'required|validate_captcha');
        if ($this->form_validation->run() == TRUE) {
            $login = $this->input->post('usuario');
            $longitud = 8;
            $new_pass = substr(MD5(rand(5, 100)), 0, $longitud);
            $identity = $this->ion_auth->where('username', $login)->users()->row();
            $datos = array(
                'ultimo_cambio_clave' => 'NULL',
                'password' => $new_pass
            );
            if ($identity) {
                if ($this->ion_auth->update($identity->id, $datos)) {
                    $this->session->unset_userdata('captchaWord');
                    $this->session->set_flashdata('message', $this->enviar_clave($identity->email, $new_pass));
                    $this->ion_auth->clear_login_attempts($login, 0);
                    redirect('menu/index');
                }
            } else {
                $this->session->set_flashdata('message', 'se ha enviado una clave nueva a su correo corporativo');
                redirect('menu/index');
            }
        } else {
            $this->session->set_flashdata('error', 'Por favor verifica los datos');
            $vals = array(
                'word' => $this->createWord(),
                'img_path' => 'captcha/',
                'img_url' => base_url() . 'captcha/',
                'img_width' => '200',
                'img_height' => 50
            );

            /* Generate the captcha */
            $captcha = create_captcha($vals);
            $this->session->set_userdata('captchaWord', $captcha['word']);
            $this->load->view('template/recuperar_clave_new', $captcha);
        }
    }

    public function enviar_clave($email, $new_pass) {
        $this->email->from('applaboratorios@gmail.com', 'Cambio Clave Herramientas de laboratorios');
        $this->email->to($email);
        $this->email->subject("Cambio de clave portal laboratorios. No responder.");
        $this->email->message("<h1>Su nueva clave para acceder al portal de laboratorios es: $new_pass</h1><h1>Una vez ingreses al portal se te pedira cambio de clave, la clave anterior que te solicita es la que acabas de generar!!.</h1>");
        if (!$this->email->send()) {
            $data['mensaje'] = "<h1>Su nueva clave para acceder al portal de laboratorios es: $new_pass</h1><h1>Una vez ingreses al portal se te pedira cambio de clave, la clave anterior que te solicita es la que acabas de generar!!.</h1>";
        } else {
            $data['mensaje'] = "Su nueva clave se a enviado a su correo corporativo";
        }
        return $data['mensaje'];
    }

    public function menu_ppal() {
        // echo $this->ion_auth->user()->row()->username;
        if ($this->ion_auth->logged_in()) {
            log_message('debug', 'sigue logueado');
            //  echo 'esta logueado';            
            //$this->data['mensaje'] = 'Bienvenido al nuevo portal de gestion de ventas, en la parte superior encontraras el acceso a los componentes para ingreso, consulta y gestion segun sea su perfil, si esta accediendo a travez de un smartphone el menu esta en la parte superior derecha. En la parte inferior estan los accesos directos a las herramientas mas usadas.';
            $this->data['template'] = 'dashboard/dashboard';
            $this->data['nombre'] = mb_convert_case($this->ion_auth->user()->row()->username, MB_CASE_TITLE, "UTF-8");
            $this->load->view('template/template', $this->data);
        }
        // print_r($this->ion_auth->user()->row());
    }

    //si el browser es ie9 o inferior

    public function browser() {
        $this->load->view('template/browser');
    }

}
