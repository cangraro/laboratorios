<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Proveedores extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->model('Equipos_model');
        $this->load->model('Proveedores_model');
        $this->load->model('Administracion_model');
        $this->load->model('Permisos_model');
        if ($this->Permisos_model->get_permission()) {
            
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente');
            redirect();
        }
    }

    public function index() {
        if ($this->ion_auth->logged_in()) {
            log_message('debug', 'sigue logueado');
            $this->data['tipos_documentos'] = $this->Equipos_model->obtenerSelectores('tipos_documentos');
            $this->data['template'] = 'proveedores/index';
            $this->load->view('template/template', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }

    public function buscar_proveedor() {
        $this->form_validation->set_rules('tipos_documentos', 'Tipo de Documento', 'required');
        if ($this->input->post('tipos_documentos') == 1) {
            $this->form_validation->set_rules('documento_id', 'Documento', 'required|min_length[9]|numeric|callback_check_nit');
        } else {
            $this->form_validation->set_rules('documento_id', 'Documento', 'required|numeric');
        }
        if ($this->form_validation->run() == false) {
            echo validation_errors();
            return;
        } else {
            $data['tiposDocumento'] = $this->Equipos_model->obtenerSelectores('tipos_documentos');
            $data['departamentos'] = $this->Equipos_model->obtenerSelectores('departamentos');
            $data['ciudades'] = $this->Equipos_model->obtenerSelectores('ciudades');
            $data['ciudad'] = array("" => "Seleccione una opción");
            $where['p.documento'] = $this->input->post("documento_id");
            $where['p.tipo_documento'] = $this->input->post("tipos_documentos");
            $digito = $this->calcular_digito_nit($this->input->post("documento_id"));
            $resultado = $this->Proveedores_model->obtenerProveedor($where);
        }
        if ($resultado->num_rows() > 0) {
            $data['proveedor'] = $resultado->row();
            $data['respuesta'] = true;
        } else {
            $data['proveedor'] = new stdClass();
            $data['proveedor']->documento = ($where['p.tipo_documento']!="2")?$where['p.documento']."-".$digito:$where['p.documento'];
            $data['proveedor']->digito = $digito;
            $data['proveedor']->tipo_documento = $where['p.tipo_documento'];
            $data['respuesta'] = false;
        }
        if ($this->input->post("bandera") != '') {
            $return['vista_proveedor'] = $this->load->view('proveedores/datos_proveedor', $data, true, false);
        } else {
            $return['vista_proveedor'] = $this->load->view('proveedores/gestion_proveedor', $data, true, false);
        }
        echo json_encode($return);
    }

    public function guardar_proveedor() {
        $data['documento'] = $this->input->post("documento");
        $data['tipo_documento'] = $this->input->post("tipo_documento");
        $data['nombre_cliente'] = $this->input->post("nombre_proveedor");
        $data['ciudad_id'] = $this->input->post("ciudades");
        $data['direccion'] = $this->input->post("direccion");
        $data['email'] = $this->input->post("email");
        $data['telefono'] = $this->input->post("telefono");
        $data['celular'] = $this->input->post("celular");
        $data['digito_verificacion'] = $this->calcular_digito_nit($this->input->post("documento"));
        $where['documento']=$this->input->post("documento");        
        $where['tipo_documento']=$this->input->post("tipo_documento");        
        $resultado = $this->Proveedores_model->obtenerProveedor($where);
        if ($resultado->num_rows() > 0) {
            $this->Equipos_model->actualizar_registro($data, $where, "proveedores");
            $retorno['respuesta'] = true;
            $retorno['mensaje'] = 'Registro actualizado con exito';
        } elseif ($data['documento'] != '') {
            
            $dataPro['id_proveedor'] = $this->Equipos_model->insertar_registro($data, "proveedores");
            $retorno['respuesta'] = true;
            $retorno['mensaje'] = 'Registro insertado con exito';
        } else {
            $retorno['respuesta'] = false;
            $retorno['mensaje'] = 'No se pudo insertar el registro';
        }

        echo json_encode($retorno);
    }

    public function check_nit($nit) {
        $invalido = array('0', '1', '2', '3', '4', '5');

        if (in_array(substr($nit, 0, 1), $invalido) || strlen($nit) != 9) {
            $this->form_validation->set_message('check_nit', 'El %s Nit debe empezar por 9,8,7,6');
            return FALSE;
        } elseif (strpos($nit, ',') !== false || strpos($nit, '.') !== false || strpos($nit, '-') !== false) {
            $this->form_validation->set_message('check_nit', "El %s Nit no puede contener caracteres (- . ,).");
            return FALSE;
        } else {
            return true;
        }
    }

    private function calcular_digito_nit($nit) {
        $primos = array(3, 7, 13, 17, 19, 23, 29, 37, 41, 43, 47, 53, 59, 67, 71);
        $temp = "";
        $suma = 0;
        $salida = "";
        for ($i = 0; $i < strlen($nit); $i++) {
            $temp = substr($nit, (strlen($nit) - 1) - $i, 1);
            $suma += (int) $temp * $primos[$i];
        }
        $residuo = $suma % 11;
        if ($residuo > 1) {
            $salida = 11 - $residuo;
        } else {
            $salida = $residuo;
        }
        return $salida;
    }

    public function obtener_ciudades() {

        if ($this->input->post("departamento") != '') {
            $where['id_departamento'] = $this->input->post("departamento");
            $arreglo = $this->Administracion_model->obtenerCiudades($where);
        } else {
            $arreglo = array();
        }
        $selector = '<option value="" selected="selected">Seleccione una opción</option>';
        foreach ($arreglo as $key => $value) {
            $selector = $selector . '<option value="' . $key . '">' . $value . '</option>';
        }
        echo json_encode($selector);
    }

}
