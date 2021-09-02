<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Equipos extends CI_Controller {
    private $clave = 'Laboratorio MEB';
    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->model('Equipos_model');
        $this->load->model('Permisos_model');
        if ($this->Permisos_model->get_permission()) {
            
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente');
            redirect();
        }
    }

    public function index() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            log_message('debug', 'sigue logueado');
            $this->data['template'] = 'equipos/index';
            $this->load->view('template/template', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }

    private function obtenerManuales() {
        $array = array();
        $array[""] = "Seleccione una opción";
        $array["0"] = "No";
        $array["1"] = "Si";
        return $array;
    }

    public function buscar_equipos() {
        $tipo_busqueda = $this->input->post("tipoBusqueda");
        if ($tipo_busqueda != '2') {
            $where['placa_inventario'] = $this->input->post("equipo_id");
            $resultado = $this->Equipos_model->obtenerEquipos($where);
            $data['marcas'] = $this->Equipos_model->obtenerSelectores('marcas');
            $data['sedes'] = $this->Equipos_model->obtenerSelectores('sedes');
            $data['ubicaciones'] = $this->Equipos_model->obtenerSelectores('ubicacion');
            $data['ubicacion'] = array('' => 'Seleccione una opción');
            $data['tipoEquipo'] = $this->Equipos_model->obtenerSelectores('tipos_equipos');
            $data['estados'] = $this->Equipos_model->obtenerSelectores('estados_equipos');
            $data['proveedores'] = $this->Equipos_model->obtenerProveedores();
            $data['manuales'] = $this->obtenerManuales();            

            if ($resultado->num_rows() > 0) {
                $data['equipo'] = $resultado->row();
                $data['respuesta'] = true;
            } else {
                $data['equipo'] = new stdClass();
                $data['equipo']->placa_inventario = $where['placa_inventario'];
                $data['respuesta'] = false;
                $data["mensaje"] = "<h4>El equipo con placa " . $where['placa_inventario'] . " no esta creado en el sistema. Puede crearlo <a href='" . base_url() . "equipos' >Aquí</a> " . "</h4>";
            }
            if ($this->input->post("bandera") != '') {
                $return['vista_equipo'] = $this->load->view('equipos/datos_equipos', $data, true, false);
            } else {
                $return['vista_equipo'] = $this->load->view('equipos/gestion_equipo', $data, true, false);
            }
        } else {
            $where['s.id'] = $this->input->post("sedes");
            $resultados = $this->Equipos_model->obtenerEquipos($where);
            $data['equipos'] = $resultados->result_object();
            $return['vista_equipo'] = $this->load->view('equipos/tablaEquipos', $data, true, false);
        }

        echo json_encode($return);
    }

    public function guardar_equipos() {
        $data['descripcion'] = $this->input->post("descripcion");
        $data['marcas_id'] = $this->input->post("marcas");
        $data['modelo'] = $this->input->post("modelo");
        $data['ubicacion_id'] = $this->input->post("ubicaciones");
        $data['no_serie'] = $this->input->post("no_serie");
        $data['fecha_compra'] = $this->input->post("fecha_compra");
        $data['placa_inventario'] = $this->input->post("equipo_id");
        $data['id_tipos_equipos'] = $this->input->post("tipoEquipo");
        $data['periodicidad_mantenimiento'] = $this->input->post("periodicidad_mto");
        $data['voltaje'] = $this->input->post("voltaje");
        $data['corriente'] = $this->input->post("corriente");
        $data['frecuencia'] = $this->input->post("frecuencia");
        $data['peso'] = $this->input->post("peso");
        $data['largo'] = $this->input->post("largo");
        $data['ancho'] = $this->input->post("ancho");
        $data['alto'] = $this->input->post("alto");
        $data['rangos_id'] = $this->input->post("rangos");
        $data['observacion'] = $this->input->post("observacion");
        $data['id_manuales'] = $this->input->post("manuales");
        $data['estado'] = ($this->input->post("estado") != "") ? $this->input->post("estado") : '1';
        $data['id_proveedor'] = $this->input->post("proveedores");
        $data['fecha_fin_garantia'] = ($this->input->post("fecha_fin_garantia") != "") ? $this->input->post("fecha_fin_garantia") : null;
        $where['placa_inventario'] = $data['placa_inventario'];
        $resultado = $this->Equipos_model->obtenerEquipos($where);
        $data['ubicacion_foto'] = (isset($_FILES[0])) ? $this->adjuntarImagen($_FILES[0], $data['placa_inventario']) : $resultado->row()->ubicacion_foto;
        if ($data['ubicacion_foto'] != '') {
            if ($resultado->num_rows() > 0) {
                $this->Equipos_model->actualizar_registro($data, $where, "equipos");
                $retorno['respuesta'] = true;
                $retorno['mensaje'] = 'Registro actualizado con exito';
            } elseif ($data['placa_inventario'] != '') {
                $init_date = strtotime("now");
                $dataPro['id_equipo'] = $this->Equipos_model->insertar_registro($data, "equipos");
                $dataPro['tipos_procedimientos_id'] = "1";
                $dataPro['fecha_programada'] = date("Y-m-d", strtotime("+ " . $data['periodicidad_mantenimiento'] . " months", $init_date));
                $dataPro['users_id_sol'] = $this->ion_auth->user()->row()->id;
                $dataPro['tipo_servicios_id'] = "1";
                $dataPro['estado'] = "1";
                $dataPro['Observacion'] = "Primer procedimiento programado.";
                $this->Equipos_model->insertar_registro($dataPro, "procedimientos");
                $retorno['respuesta'] = true;
                $retorno['mensaje'] = 'Registro insertado con exito';
            } else {
                $retorno['respuesta'] = false;
                $retorno['mensaje'] = 'No se pudo insertar el registro';
            }
        } else {
            $retorno['respuesta'] = false;
            $retorno['mensaje'] = 'No se pudo cargar la fotografia';
        }
        echo json_encode($retorno);
    }

    public function adjuntarImagen($files, $equipo_id) {
        if ($files['tmp_name']) {
            $errors = array();
            $maxsize = 3145728;
            $acceptable = array(
                'image/jpeg'
            );
            if (($files['size'] > $maxsize) || ($files["size"] == 0)) {
                $return = "";
                return $return;
            }
            //print_r($files['type']);
            if ((!in_array($files['type'], $acceptable)) && (!empty($files["type"]))) {
                $return = "";
                return $return;
            }
            if (count($errors) === 0) {
                $path = $files['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $nombre_archivo = $equipo_id . '_imagen.' . $ext;
                $ruta = BASEPATH . '../adj_equipos/' . $equipo_id . '/';
                $ruta_relativa = 'adj_equipos/' . $equipo_id . '/' . $nombre_archivo;
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                if (move_uploaded_file($files['tmp_name'], $ruta . $nombre_archivo)) {
                    $return = $ruta_relativa;
                } else {
                    $return = "";
                }
                return $return;
            } else {
                $return = "";
                return $return;
            }
        } else {
            $return = "";
            return $return;
        }
    }

    public function obtener_ubicaciones() {

        if ($this->input->post("sedes") != '') {
            $where['sedes_id'] = $this->input->post("sedes");
            $arreglo = $this->Administracion_model->obtenerSedes($where);
        } else {
            $arreglo = array();
        }
        $selector = '<option value="" selected="selected">Seleccione una opción</option>';
        foreach ($arreglo as $key => $value) {
            $selector = $selector . '<option value="' . $key . '">' . $value . '</option>';
        }
        echo json_encode($selector);
    }

    public function consulta_equipos() {
        if ($this->ion_auth->logged_in()) {
            log_message('debug', 'sigue logueado');
            $this->data["tipoBusqueda"] = $this->obtenerTiposConsulta();
            $this->data["sedes"] = $this->Equipos_model->obtenerSelectores('sedes');
            $this->data['template'] = 'equipos/consulta_equipos';
            $this->load->view('template/template', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }

    private function obtenerTiposConsulta() {
        $arreglo = array();
        $arreglo["1"] = "Placa";
        $arreglo["2"] = "Sede";
        return $arreglo;
    }

    public function guias() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            log_message('debug', 'sigue logueado');
            $this->data['template'] = 'equipos/guias';
            $this->load->view('template/template', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }

    public function buscar_equipos_guias() {
        $where['placa_inventario'] = $this->input->post("equipo_id");
        $resultado = $this->Equipos_model->obtenerEquipos($where);
        if ($resultado->num_rows() > 0) {
            $data['equipo'] = $resultado->row();
            $data['respuesta'] = true;
        } else {
            $data['respuesta'] = false;
            $data['mensaje'] = "El equipo no existe, por favor crearlo <a href='" . base_url() . "equipos' >Crear Equipo</a>";
        }
        $return['vista_equipo'] = $this->load->view('equipos/guias_resultado_equipo', $data, true, false);
        echo json_encode($return);
    }

    public function actualizar_guia() {
        $id = $this->input->post("id");
        $equipo_id = $this->input->post("placa");
        if ($_FILES[0]['tmp_name']) {
            $errors = array();
            $maxsize = 3145728;
            $acceptable = array(
                'application/pdf'
            );
            if (($_FILES[0]['size'] > $maxsize) || ($_FILES[0]["size"] == 0)) {
                $return['mensaje'] = "El archivo supera el tamaño máximo permitido 3 Mb";
                $errors[] = 'Archivo muy grande, Maximo permitido es 3MB';
                $return['respuesta'] = false;
                echo json_encode($return);
            }
            //print_r($files['type']);
            if ((!in_array($_FILES[0]['type'], $acceptable)) && (!empty($_FILES[0]["type"]))) {
                $return['mensaje'] = "El formato del archivo no corresponde al formato aceptado .pdf";
                $errors[] = 'tipo de archivo invalido. Solo los tipo PDF estan permitidos';
                $return['respuesta'] = false;
                echo json_encode($return);
            }
            if (count($errors) === 0) {
                $path = $_FILES[0]['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $nombre_archivo = $equipo_id . '_guia.' . $ext;
                $ruta = BASEPATH . '../adj_equipos/' . $equipo_id . '/';
                $ruta_relativa = 'adj_equipos/' . $equipo_id . '/' . $nombre_archivo;
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                if (move_uploaded_file($_FILES[0]['tmp_name'], $ruta . $nombre_archivo)) {
                    $set = array();
                    $where = array();
                    $set["ubicacion_guia"] = $ruta_relativa;
                    $where["id"] = $id;
                    $this->Equipos_model->actualizar_registro($set, $where, "equipos");
                    $return['mensaje'] = "Archivo actualizado con éxito";
                    $return['respuesta'] = true;
                    echo json_encode($return);
                } else {
                    $return['mensaje'] = "Possible file upload attack!\n";
                    $return['respuesta'] = false;
                    echo json_encode($return);
                }
            } else {
                $return['mensaje'] = "No se adjunto el archivo";
                $return['respuesta'] = false;
                echo json_encode($return);
            }
        }
    }

    function generar_documentos() {
        $id = $this->input->post('id');
        $clave = $this->clave;
        $this->load->library('m_pdf');
        setlocale(LC_TIME, "es_CO");
        $pdf = $this->m_pdf->load("hoja_de_vida");
        $pdf->mirrorMargins = 1;
        $pdf->SetProtection(array('print'), '', '', 128);
        $where['placa_inventario'] = $id;
        $resultado = $this->Equipos_model->obtenerEquipos($where);
        $equipo = $resultado->row();        
        $pdf->SetHTMLFooter('<div >Hoja de vida ' . $equipo->placa_inventario . ' generada el ' . date('d/m/Y') . ' pag.{PAGENO}</div>', 'O');
        $pdf->SetWatermarkText($clave);
        $pdf->showWatermarkText = true;
        $pdf->showImageErrors = true;
        $html = $this->load->view('documentos/hoja_de_vida_equipo', $equipo, true, false);        
        $html_fix = str_replace('localhost', '127.0.0.1', $html);
        $html_fix = str_replace('localhost', '127.0.0.1', $html_fix);
        //echo $html_fix;
        //die;
        $pdf->WriteHTML($html_fix); // write the HTML into the PDF        
        $ruta = BASEPATH . '../tmp/';
        $pdf->Output($ruta . 'hoja_de_vida_' . $id . '.pdf', 'F');
        $ruta_relativa = base_url() . 'tmp/' . 'hoja_de_vida_' . $id . '.pdf';
        $data_r['url'] = $ruta_relativa;
        $data_r['path'] = $ruta . 'hoja_de_vida_' . $id . '.pdf';
        $data_r['nombre'] = 'hoja_de_vida_' . $id . '.pdf';
        $data_r['resultado'] = 1;
        echo json_encode($data_r);
    }
    
    public function docu_legal() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            log_message('debug', 'sigue logueado');
            $this->data['template'] = 'equipos/docu_legal';
            $this->load->view('template/template', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }
    
    public function buscar_equipos_documento_legal() {
        $where['placa_inventario'] = $this->input->post("equipo_id");
        $resultado = $this->Equipos_model->obtenerEquipos($where);
        if ($resultado->num_rows() > 0) {
            $data['equipo'] = $resultado->row();
            $data['respuesta'] = true;
        } else {
            $data['respuesta'] = false;
            $data['mensaje'] = "El equipo no existe, por favor crearlo <a href='" . base_url() . "equipos' >Crear Equipo</a>";
        }
        $return['vista_equipo'] = $this->load->view('equipos/documentacion_legal', $data, true, false);
        echo json_encode($return);
    }
    
    public function actualizar_documentacion_legal() {
        $id = $this->input->post("id");
        $equipo_id = $this->input->post("placa");
        if ($_FILES[0]['tmp_name']) {
            $errors = array();
            $maxsize = 3145728;
            $acceptable = array(
                'application/pdf'
            );
            if (($_FILES[0]['size'] > $maxsize) || ($_FILES[0]["size"] == 0)) {
                $return['mensaje'] = "El archivo supera el tamaño máximo permitido 3 Mb";
                $errors[] = 'Archivo muy grande, Maximo permitido es 3MB';
                $return['respuesta'] = false;
                echo json_encode($return);
            }
            //print_r($files['type']);
            if ((!in_array($_FILES[0]['type'], $acceptable)) && (!empty($_FILES[0]["type"]))) {
                $return['mensaje'] = "El formato del archivo no corresponde al formato aceptado .pdf";
                $errors[] = 'tipo de archivo invalido. Solo los tipo PDF estan permitidos';
                $return['respuesta'] = false;
                echo json_encode($return);
            }
            if (count($errors) === 0) {
                $path = $_FILES[0]['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $nombre_archivo = $equipo_id . '_documentacion_legal.' . $ext;
                $ruta = BASEPATH . '../adj_equipos/' . $equipo_id . '/';
                $ruta_relativa = 'adj_equipos/' . $equipo_id . '/' . $nombre_archivo;
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                if (move_uploaded_file($_FILES[0]['tmp_name'], $ruta . $nombre_archivo)) {
                    $set = array();
                    $where = array();
                    $set["ubicacion_documentacion_legal"] = $ruta_relativa;
                    $where["id"] = $id;
                    $this->Equipos_model->actualizar_registro($set, $where, "equipos");
                    $return['mensaje'] = "Archivo actualizado con éxito";
                    $return['respuesta'] = true;
                    echo json_encode($return);
                } else {
                    $return['mensaje'] = "Possible file upload attack!\n";
                    $return['respuesta'] = false;
                    echo json_encode($return);
                }
            } else {
                $return['mensaje'] = "No se adjunto el archivo";
                $return['respuesta'] = false;
                echo json_encode($return);
            }
        }
    }
}
