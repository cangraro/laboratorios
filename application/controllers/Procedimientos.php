<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Procedimientos extends CI_Controller {
    private $clave = 'Laboratorio MEB';
    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->model('Procedimientos_model');
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
            $this->data['template'] = 'Procedimientos/index';
            $this->load->view('template/template', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }

    function cargarProcedimientosProgramados() {
        $this->cargarProcedimientos('1');
    }

    function cargarProcedimientosSolicitados() {
        $this->cargarProcedimientos('2');
    }

    function cargarProcedimientos($tipo_soicitud) {
        $where['tipos_procedimientos_id'] = $tipo_soicitud;
        $where['p.estado'] = "1";
        $data['procedimientos'] = $this->Procedimientos_model->obtenerProcedimientos($where);
        $return['html'] = $this->load->view('procedimientos/listaProcedimientos', $data, true, false);
        $return['cantidad'] = $data['procedimientos']->num_rows();
        echo json_encode($return);
    }

    function obtenerProcedimiento() {
        $where['p.id'] = $this->input->post("id");
        $where['p.estado'] = $this->input->post("estado");
        $datos['procedimientos'] = $this->Procedimientos_model->obtenerProcedimientos($where)->result_array();
        $whereP["ap.id_procedimiento"] = $where['p.id'];
        $whereR["r.procedimiento_id"] = $where['p.id'];
        $data = $datos['procedimientos'][0];
        $data["actividades"] = $this->Procedimientos_model->obtenerActividadesProcedimiento($whereP);
        $data["repuestos"] = $this->Procedimientos_model->obtenerRepuestosProcedimiento($whereR);
        $return['html'] = $this->load->view('procedimientos/resumenProcedimiento', $data, true, false);
        echo json_encode($return);
    }

    function crear_procedimientos() {
        if ($this->ion_auth->logged_in()) {
            log_message('debug', 'sigue logueado');
            $this->data['template'] = 'Procedimientos/crearProcedimientos';
            $this->load->view('template/template', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }

    public function buscar_equipos() {
        $where['placa_inventario'] = $this->input->post("equipo_id");
        $resultado = $this->Equipos_model->obtenerEquipos($where);
        if ($resultado->num_rows() > 0) {
            $data['tipo_servicios'] = $this->Equipos_model->obtenerSelectores('tipo_servicios');
            $data['equipo'] = $resultado->row();
            $data['respuesta'] = true;
        } else {
            $data['equipo'] = new stdClass();
            $data['equipo']->placa_inventario = $where['placa_inventario'];
            $data['respuesta'] = false;
            $data["mensaje"] = "<h4>El equipo con placa " . $where['placa_inventario'] . " no esta creado en el sistema." . "</h4>";
        }
        $return['vista_equipo'] = $this->load->view('procedimientos/datosEquipo', $data, true, false);

        echo json_encode($return);
    }

    function obtener_ans_tipo_servicio() {
        $where["id"] = $this->input->post("tipo_servicio");
        $datos = $this->Procedimientos_model->obtenerAnsTipoServicio($where);
        if ($datos->num_rows() > 0) {
            $init_date = strtotime("now");
            $fecha_tentativa = date("Y-m-d", strtotime("+ " . $datos->row()->ans . " days", $init_date));
            $retorno["mensaje"] = "Su solicitud será atendida aproximadamente el " . $fecha_tentativa;
            $retorno['respuesta'] = true;
        } else {
            $retorno["mensaje"] = "";
            $retorno['respuesta'] = false;
        }
        echo json_encode($retorno);
    }

    function guardar_procedimientos() {
        $where["id"] = $this->input->post("tipo_servicio");
        $datos = $this->Procedimientos_model->obtenerAnsTipoServicio($where);
        $init_date = strtotime("now");
        $dataPro['tipos_procedimientos_id'] = "2";
        $dataPro['id_equipo'] = $this->input->post("id");
        $dataPro['fecha_programada'] = date("Y-m-d", strtotime("+ " . $datos->row()->ans . " days", $init_date));
        $dataPro['users_id_sol'] = $this->ion_auth->user()->row()->id;
        $dataPro['tipo_servicios_id'] = $this->input->post("tipo_servicio");
        $dataPro['estado'] = "1";
        $dataPro['Observacion'] = $this->input->post("observacion");
        $resultado = $this->Equipos_model->insertar_registro($dataPro, "procedimientos");
        if ($resultado != "") {
            $retorno['respuesta'] = true;
            $retorno['mensaje'] = '<h4>Procedimiento insertado con número ' . $resultado . "</h4>";
        } else {
            $retorno['respuesta'] = false;
            $retorno['mensaje'] = "<h4>No se creo el procedimiento.</h4>";
        }
        echo json_encode($retorno);
    }

    function gestionarProcedimiento() {
        $where['p.id'] = $this->input->post("id");
        $data["procedimientos"] = $this->Procedimientos_model->obtenerProcedimientos($where);
        $whereA["id_tipos_equipos"] = $data["procedimientos"]->row()->id_tipos_equipos;
        $data["actividades"] = $this->Procedimientos_model->obtenerActividades($whereA);
        $data['resultados'] = $this->Equipos_model->obtenerSelectores('resultados');
        $return['vista_gestion'] = $this->load->view('procedimientos/datosGestionProcedimiento', $data, true, false);
        echo json_encode($return);
    }

    function gestionarLegalizacionProcedimiento() {
        $where['p.id'] = $this->input->post("id");
        $data["procedimientos"] = $this->Procedimientos_model->obtenerProcedimientos($where);
        $return['vista_gestion'] = $this->load->view('procedimientos/datosLegalizacionProcedimiento', $data, true, false);
        echo json_encode($return);
    }

    function guardar_resultado_procedimiento() {
        $contador = $this->input->post("cantidadActividades");
        $id = $this->input->post("procedimiento_id");
        $observacion = $this->input->post("observacion");
        $cont = $this->input->post("cont");
        $actividades = array();
        for ($i = 0; $i < $contador; $i++) {
            $actividades["id_procedimiento"] = $id;
            $actividades["id_actividad"] = $this->input->post("actividad" . $i);
            $actividades["id_resultado"] = $this->input->post("resultados" . $i);
            $this->Equipos_model->insertar_registro($actividades, "actividades_procedimientos");
        }
        if ($cont > 0) {
            $repuestos = array();
            for ($i = 1; $i <= $cont; $i++) {
                if ($this->input->post("descripcion_repuesto" . $i) != '') {
                    $repuestos[$i]["procedimiento_id"] = $id;
                    $repuestos[$i]["descripcion_repuesto"] = $this->input->post("descripcion_repuesto" . $i);
                    $repuestos[$i]["cantidad"] = $this->input->post("cantidad" . $i);
                }
            }
            foreach ($repuestos as $value) {
                $this->Equipos_model->insertar_registro($value, "repuestos_procedimientos");
            }
        }

        $datos["estado"] = "2";
        $datos["observacion_cierre"] = $observacion;
        $datos["fecha_ejecucion"] = date("Y-m-d");
        $datos["users_id_ejec"] = $this->ion_auth->user()->row()->id;
        $where["p.id"] = $id;
        if ($this->Equipos_model->actualizar_registro($datos, $where, "procedimientos p")) {
            $data["respuesta"] = true;
            $data["mensaje"] = "Se actualizo con exito el procedimiento número " . $id;
            $datos_procedimiento_equipo = $this->Procedimientos_model->obtener_procedimiento_equipo($where);
            if ($datos_procedimiento_equipo->tipos_procedimientos_id == '1') {
                $init_date = strtotime("now");
                $dataPro['id_equipo'] = $datos_procedimiento_equipo->id;
                $dataPro['tipos_procedimientos_id'] = "1";
                $dataPro['fecha_programada'] = date("Y-m-d", strtotime("+ " . $datos_procedimiento_equipo->periodicidad_mantenimiento . " months", $init_date));
                $dataPro['users_id_sol'] = $this->ion_auth->user()->row()->id;
                $dataPro['tipo_servicios_id'] = "1";
                $dataPro['estado'] = "1";
                $dataPro['Observacion'] = "Procedimiento programado automatico.";
                $this->Equipos_model->insertar_registro($dataPro, "procedimientos");
            }
        } else {
            $data["respuesta"] = false;
            $data["mensaje"] = "Hubo un problema al cerrar el procedimiento número " . $id;
        }

        $retorno["vista"] = $this->load->view('procedimientos/resultadoProcedimiento', $data, true, false);
        echo json_encode($retorno);
    }

    public function consulta_procedimientos() {
        if ($this->ion_auth->logged_in()) {
            log_message('debug', 'sigue logueado');
            $this->data["tipoBusqueda"] = $this->obtenerTiposConsulta();
            $this->data['template'] = 'procedimientos/consulta_procedimientos';
            $this->load->view('template/template', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }

    private function obtenerTiposConsulta() {
        $arreglo = array();
        $arreglo["1"] = "Número de placa";
        $arreglo["2"] = "Número de procedimiento";
        return $arreglo;
    }

    function buscar_procedimientos_por_tipo() {
        $tipo_busqueda = $this->input->post("tipoBusqueda");
        $id = $this->input->post("id");
        if ($tipo_busqueda == "1") {
            $where['e.placa_inventario'] = $id;
            $datos['procedimientos'] = $this->Procedimientos_model->obtenerProcedimientos($where)->result_array();
            if (isset($datos['procedimientos'][0])) {
                $data["id"] = $id;
                $data["bandera"] = false;
                $return['vista'] = $this->load->view('procedimientos/resultados_procedimientos', $data, true, false);
                $return["respuesta"] = true;
            } else {
                $return["respuesta"] = false;
                $return["mensaje"] = "No existen procedimientos asociadas a la placa " . $id;
            }
        } elseif ($tipo_busqueda == "2") {
            $where['p.id'] = $id;
            $datos['procedimientos'] = $this->Procedimientos_model->obtenerProcedimientos($where)->result_array();

            if (isset($datos['procedimientos'][0])) {
                $whereP["ap.id_procedimiento"] = $id;
                $whereR["r.procedimiento_id"] = $id;
                $data = $datos['procedimientos'][0];
                $data["actividades"] = $this->Procedimientos_model->obtenerActividadesProcedimiento($whereP);
                $data["repuestos"] = $this->Procedimientos_model->obtenerRepuestosProcedimiento($whereR);
                $return['vista'] = $this->load->view('procedimientos/resumenProcedimiento', $data, true, false);
                $return["respuesta"] = true;
            } else {
                $return["respuesta"] = false;
                $return["mensaje"] = "No existe el procedimiento número " . $id;
            }
        }
        echo json_encode($return);
    }

    function cargarProcedimientosPendientes() {
        $id = $this->input->post("id");
        $bandera = $this->input->post("bandera");
        $this->cargarProcedimientosPorId(array('1'), $id, $bandera);
    }

    function cargarProcedimientosEjecutados() {
        $id = $this->input->post("id");
        $bandera = $this->input->post("bandera");
        $this->cargarProcedimientosPorId(array('2', '3'), $id, $bandera);
    }

    function cargarProcedimientosPorId($estado, $id, $bandera) {
        $where['e.placa_inventario'] = $id;
        $data['procedimientos'] = $this->Procedimientos_model->obtenerProcedimientos($where, $estado);
        $data["gestion"] = false;
        $data['bandera'] = $bandera;
        $return['html'] = $this->load->view('procedimientos/listaProcedimientos', $data, true, false);
        $return['cantidad'] = $data['procedimientos']->num_rows();
        echo json_encode($return);
    }

    public function editar_fechas() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            log_message('debug', 'sigue logueado');
            $this->data['template'] = 'Procedimientos/editar_fechas';
            $this->load->view('template/template', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }

    function buscar_procedimientos_editar() {
        $where['p.id'] = $this->input->post("procedimiento");
        $where['p.estado'] = "1";
        $datos['procedimientos'] = $this->Procedimientos_model->obtenerProcedimientos($where)->result_array();
        if (isset($datos['procedimientos'][0])) {
            $data = $datos['procedimientos'][0];
            $return['vista'] = $this->load->view('procedimientos/resultado_procedimiento', $data, true, false);
            $return["respuesta"] = true;
        } else {
            $return["respuesta"] = false;
            $return["mensaje"] = "No existe el procedimiento número " . $where['p.id'] . " o no se encuentra en estado pendiente";
        }
        echo json_encode($return);
    }

    function actualizar_fecha() {
        $where['id'] = $this->input->post("id");
        $set['fecha_programada'] = $this->input->post("fecha_programada");
        if ($this->Equipos_model->actualizar_registro($set, $where, "procedimientos")) {
            $return["respuesta"] = true;
            $return["mensaje"] = "La fecha se actualizó correctamente";
        } else {
            $return["respuesta"] = false;
            $return["mensaje"] = "Hubo un problema al actualizar la fecha";
        }
        echo json_encode($return);
    }

    function calibraciones() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            log_message('debug', 'sigue logueado');
            $this->data['template'] = 'Procedimientos/calibraciones';
            $this->load->view('template/template', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }

    public function buscar_equipo_calibraciones() {
        $where['placa_inventario'] = $this->input->post("equipo_id");
        $resultado = $this->Equipos_model->obtenerEquipos($where);
        $data['tipo_servicios'] = $this->Equipos_model->obtenerSelectores('tipo_servicios');
        if ($resultado->num_rows() > 0) {
            $data['equipo'] = $resultado->row();            
            $data['respuesta'] = true;
        } else {
            $data['equipo'] = new stdClass();
            $data['equipo']->placa_inventario = $where['placa_inventario'];
            $data['respuesta'] = false;
            $data["mensaje"] = "<h4>El equipo con placa " . $where['placa_inventario'] . " no esta creado en el sistema." . "</h4>";
        }
        $return['vista_equipo'] = $this->load->view('procedimientos/datosEquipoCalibracion', $data, true, false);

        echo json_encode($return);
    }

    public function guardar_calibracion() {
        $dataPro['tipos_procedimientos_id'] = "3";
        $dataPro['id_equipo'] = $this->input->post("id");        
        $dataPro['fecha_programada'] = date("Y-m-d");
        $dataPro['fecha_ejecucion'] = date("Y-m-d");
        $dataPro['users_id_sol'] = $this->ion_auth->user()->row()->id;
        $dataPro['tipo_servicios_id'] = $this->input->post("tipo_servicio");
        $dataPro['estado'] = "3";
        $dataPro['Observacion'] = $this->input->post("observacion");
        $resultado = $this->Equipos_model->insertar_registro($dataPro, "procedimientos");
        $set["ruta_documento"] = $this->adjuntarArchivo($_FILES[0], $resultado);
        $where["id"] = $resultado;
        $this->Equipos_model->actualizar_registro($set, $where, "procedimientos");
        if ($resultado != "") {
            $retorno['respuesta'] = true;
            if (!is_null($set["ruta_documento"])) {
                $retorno['mensaje'] = '<h4>Procedimiento insertado con número ' . $resultado . "</h4>";
            } else {
                $retorno['mensaje'] = '<h4>Procedimiento insertado con número ' . $resultado . ", no se adjunto el documento.</h4>";
            }
        } else {
            $retorno['respuesta'] = false;
            $retorno['mensaje'] = "<h4>No se creo el procedimiento.</h4>";
        }
        echo json_encode($retorno);
    }

    function agregar_repuesto() {
        $data = array();
        $i = $this->input->post('cont');
        $data['datos'][$i]['datos_repuestos']['descripcion_repuesto'] = $this->input->post('descripcion_repuesto');
        $data['datos'][$i]['datos_repuestos']['cantidad'] = $this->input->post('cantidad');
        $data['datos'][$i]['descripcion_repuesto'] = $this->input->post('descripcion_repuesto');
        $data['datos'][$i]['cantidad'] = $this->input->post('cantidad');
        $return['vista'] = $this->load->view('procedimientos/datosRepuestos', $data, true, false);
        echo json_encode($return);
    }

    public function legalizacion() {
        if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
            log_message('debug', 'sigue logueado');
            $this->data['template'] = 'Procedimientos/legalizacion';
            $this->load->view('template/template', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }

    function cargarProcedimientosLegalizacionMantenimientos() {
        $this->cargarProcedimientosLegalizacion('3');
    }

    function cargarProcedimientosLegalizacion($tipo_soicitud) {
        $where['tipos_procedimientos_id!='] = $tipo_soicitud;
        $where['p.estado'] = "2";
        $data['procedimientos'] = $this->Procedimientos_model->obtenerProcedimientos($where);
        $return['html'] = $this->load->view('procedimientos/listaProcedimientos', $data, true, false);
        $return['cantidad'] = $data['procedimientos']->num_rows();
        echo json_encode($return);
    }

    public function adjuntarArchivo($files, $id) {
        if ($files['tmp_name']) {
            $errors = array();
            $maxsize = 3145728;
            $acceptable = array(                
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/msword,',
                'application/pdf'
            );
            if (($files['size'] > $maxsize) || ($files["size"] == 0)) {
                $return = null;
                return $return;
            }
            //print_r($files['type']);
            if ((!in_array($files['type'], $acceptable)) && (!empty($files["type"]))) {
                $return = null;
                return $return;
            }
            if (count($errors) === 0) {
                $path = $files['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $nombre_archivo = $id . '_formato_legalizacion.' . $ext;
                $ruta = BASEPATH . '../adj_procedimientos/' . $id . '/';
                $ruta_relativa = 'adj_procedimientos/' . $id . '/' . $nombre_archivo;
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                if (move_uploaded_file($files['tmp_name'], $ruta . $nombre_archivo)) {
                    $return = $ruta_relativa;
                } else {
                    $return = null;
                }
                return $return;
            } else {
                $return = null;
                return $return;
            }
        } else {
            $return = null;
            return $return;
        }
    }

    public function adjuntar_documento_procedimiento() {
        $id = $this->input->post("id");
        if ($_FILES[0]['tmp_name']) {
            $errors = array();
            $maxsize = 3145728;
            $acceptable = array(
                'application/pdf',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/msword'
            );
            if (($_FILES[0]['size'] > $maxsize) || ($_FILES[0]["size"] == 0)) {
                $return['mensaje'] = "El archivo supera el tamaño máximo permitido 3 Mb";
                $errors[] = 'Archivo muy grande, Maximo permitido es 3MB';
                $return['respuesta'] = false;
                echo json_encode($return);
            }
            if ((!in_array($_FILES[0]['type'], $acceptable)) && (!empty($_FILES[0]["type"]))) {
                $return['mensaje'] = "El formato del archivo no corresponde al formato aceptado .pdf";
                $errors[] = 'tipo de archivo invalido. Solo los tipo PDF estan permitidos';
                $return['respuesta'] = false;
                echo json_encode($return);
            }
            if (count($errors) === 0) {
                $path = $_FILES[0]['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $nombre_archivo = $id . '_legalizacion.' . $ext;
                $ruta = BASEPATH . '../adj_procedimientos/' . $id . '/';
                $ruta_relativa = 'adj_procedimientos/' . $id . '/' . $nombre_archivo;
                if (!file_exists($ruta)) {
                    mkdir($ruta, 0777, true);
                }
                if (move_uploaded_file($_FILES[0]['tmp_name'], $ruta . $nombre_archivo)) {
                    $set = array();
                    $where = array();
                    $set["ruta_documento"] = $ruta_relativa;
                    $set["estado"] = '3';
                    $where["id"] = $id;
                    $this->Equipos_model->actualizar_registro($set, $where, "procedimientos");
                    $return['mensaje'] = "Procedimiento legalizado con éxito";
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
        $where['p.id'] = $id;
        $resultado = $this->Procedimientos_model->obtenerProcedimientos($where)->result_array();
        $whereP["ap.id_procedimiento"] = $id;
        $whereR["r.procedimiento_id"] = $id;
        $data = $resultado[0];
        $data["actividades"] = $this->Procedimientos_model->obtenerActividadesProcedimiento($whereP)->result_array();
        $data["repuestos"] = $this->Procedimientos_model->obtenerRepuestosProcedimiento($whereR)->result_array();
        $pdf->SetHTMLFooter('<div >Reporte de mantenimiento ' . $id . ' generado el ' . date('d/m/Y') . ' pag.{PAGENO}</div>', 'O');
        $pdf->SetWatermarkText($clave);
        $pdf->showWatermarkText = true;        
        $html = $this->load->view('documentos/reporte_mantenimiento', $data, true, false);
        $html_fix = str_replace('localhost', '127.0.0.1', $html);
        $html_fix = str_replace('localhost', '127.0.0.1', $html_fix);
        $pdf->WriteHTML($html_fix); // write the HTML into the PDF        
        $ruta = BASEPATH . '../tmp/';
        $pdf->Output($ruta . 'reporte_mantenimiento_' . $id . '.pdf', 'F');
        $ruta_relativa = base_url() . 'tmp/' . 'reporte_mantenimiento_' . $id . '.pdf';
        $data_r['url'] = $ruta_relativa;
        $data_r['path'] = $ruta . 'reporte_mantenimiento_' . $id . '.pdf';
        $data_r['nombre'] = 'reporte_mantenimiento_' . $id . '.pdf';
        $data_r['resultado'] = 1;
        echo json_encode($data_r);
    }

}
