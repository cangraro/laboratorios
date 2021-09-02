<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consultas extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->model('Consultas_model');
        $this->load->model('Equipos_model');
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
            $this->data['template'] = 'consultas/index';
            $this->data['tipos_consultas'] = $this->obtener_tipos_consultas();
            $this->load->view('template/template', $this->data);
        } else {
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }

    function obtener_tipos_consultas() {
        $array = array();
        $array[""] = "Seleccione un valor";
        $array["1"] = "Inventario";
        $array["2"] = "Procedimientos pendientes";
        $array["3"] = "Procedimientos ejecutados";
        return $array;
    }

    function escogerDescarga() {
        $tipoBusqueda = $this->input->post('tipoBusqueda');
        switch ($tipoBusqueda) {
            case '1':
                $this->obtener_inventario();
                break;
            case '2':
                $this->obtener_mantenimientos_pendientes(array("1"));
                break;
            case '3':
                $this->obtener_mantenimientos_ejecutados(array("2","3"));
                break;
            default:
                break;
        }
    }

    function obtener_inventario() {
        $this->load->library('PHPExcel');
        $datos_inventario = $this->Consultas_model->obtener_inventario();
        $ruta = BASEPATH . '../tmp/';
        $ruta_anchor = base_url() . 'tmp/';
        $nombre = 'inventario-' . date('d-m-y_h_i_s_A') . '_' . $this->ion_auth->user()->row()->username . '.xlsx';
        if ($datos_inventario->num_rows() < 0) {
            $data_return['resultado'] = 0;
        } else {
            $data_return['resultado'] = 1;
            $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_memcache;
            $cacheSettings = array('memoryCacheSize' => '1024MB');
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
            $objPHPExcel = $this->phpexcel->getActiveSheet();
            $this->phpexcel->getProperties()->setCreator("Equipo Laboratorio");
            $this->phpexcel->getProperties()->setTitle("Inventario");
            $objPHPExcel->getDefaultColumnDimension()->setWidth(20);
            $objPHPExcel->getDefaultRowDimension()->setRowHeight(15);
            $objPHPExcel->getStyle('A1:J1')->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('002e6c');
            $objPHPExcel->getStyle('A1:J1')->getFont()->getColor()->setARGB('FFFFFFFF');
            $objPHPExcel->setCellValue('A1', 'NOMBRE');
            $objPHPExcel->setCellValue('B1', 'MARCA');
            $objPHPExcel->setCellValue('C1', 'MODELO');
            $objPHPExcel->setCellValue('D1', 'SERIE');
            $objPHPExcel->setCellValue('E1', 'PLACA');
            $objPHPExcel->setCellValue('F1', 'SEDE');
            $objPHPExcel->setCellValue('G1', 'UBICACION');
            $objPHPExcel->setCellValue('H1', 'PLANEACION MANTENIMIENTO');
            $objPHPExcel->setCellValue('I1', 'MANUALES');
            $objPHPExcel->setCellValue('J1', 'OBSERVACION');
            $contador = 2;

            foreach ($datos_inventario->result_object() as $data) {
                $objPHPExcel->setCellValue('A' . $contador, $data->nombre_equipo)->setCellValue('B' . $contador, $data->marca)
                        ->setCellValue('C' . $contador, $data->modelo)
                        ->setCellValue('D' . $contador, $data->no_serie)
                        ->setCellValue('E' . $contador, $data->placa_inventario)
                        ->setCellValue('F' . $contador, $data->sede)
                        ->setCellValue('G' . $contador, $data->ubicacion)
                        ->setCellValue('H' . $contador, $data->mantenimiento)
                        ->setCellValue('I' . $contador, $data->id_manuales)
                        ->setCellValue('J' . $contador, $data->observacion);
                $contador++;
            }
            $writer = new PHPExcel_Writer_Excel2007($this->phpexcel);
            $writer->setPreCalculateFormulas(false);
            $writer->save($ruta . $nombre);
        }
        $data_return['url_descarga'] = $ruta_anchor . $nombre;
        $data_return['nombre'] = '';
        $return["vista"] = $this->load->view('consultas/resultado', $data_return, true, false);
        echo json_encode($return);
    }

    function obtener_mantenimientos_pendientes($estado) {
        $this->load->library('PHPExcel');

        $datos_mantenimiento = $this->Consultas_model->obtener_mantenimientos($estado);
        $ruta = BASEPATH . '../tmp/';
        $ruta_anchor = base_url() . 'tmp/';
        $nombre = 'procedimientos_pendientes' . date('d-m-y_h_i_s_A') . '_' . $this->ion_auth->user()->row()->username . '.xlsx';
        if ($datos_mantenimiento == false) {
            $data_return['resultado'] = 0;
        } else {
            $data_return ['resultado'] = 1;
            $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_memcache;
            $cacheSettings = array('memoryCacheSize' => '1024MB');
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
            $objPHPExcel = $this->phpexcel->getActiveSheet();
            $this->phpexcel->getProperties()->setCreator("Equipo Laboratorio");
            $this->phpexcel->getProperties()->setTitle("Inventario");
            $objPHPExcel->getDefaultColumnDimension()->setWidth(20);
            $objPHPExcel->getDefaultRowDimension()->setRowHeight(15);
            $objPHPExcel->getStyle('A1:N1')->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('002e6c');
            $objPHPExcel->getStyle('A1:N1')->getFont()->getColor()->setARGB('FFFFFFFF');
            $objPHPExcel->setCellValue('A1', 'NOMBRE');
            $objPHPExcel->setCellValue('B1', 'MARCA');
            $objPHPExcel->setCellValue('C1', 'MODELO');
            $objPHPExcel->setCellValue('D1', 'SERIE');
            $objPHPExcel->setCellValue('E1', 'PLACA');
            $objPHPExcel->setCellValue('F1', 'SEDE');
            $objPHPExcel->setCellValue('G1', 'UBICACION');
            $objPHPExcel->setCellValue('H1', 'PLANEACION MANTENIMIENTO');
            $objPHPExcel->setCellValue('I1', 'TIPO SERVICIO');
            $objPHPExcel->setCellValue('J1', 'TIPO PROCEDIMIENTO');
            $objPHPExcel->setCellValue('K1', 'FECHA PROGRAMADA');
            $objPHPExcel->setCellValue('L1', 'OBSERVACION APERTURA');
            $objPHPExcel->setCellValue('M1', 'ID_PROCEDIMIENTO');
            $objPHPExcel->setCellValue('N1', 'ESTADO_PROCEDIMIENTO');
            $contador = 2;
            foreach ($datos_mantenimiento->result_object() as $data) {
                $objPHPExcel->setCellValue('A' . $contador, $data->nombre_equipo)
                        ->setCellValue('B' . $contador, $data->marca)
                        ->setCellValue('C' . $contador, $data->modelo)
                        ->setCellValue('D' . $contador, $data->no_serie)
                        ->setCellValue('E' . $contador, $data->placa_inventario)
                        ->setCellValue('F' . $contador, $data->sede)
                        ->setCellValue('G' . $contador, $data->ubicacion)
                        ->setCellValue('H' . $contador, $data->mantenimiento)
                        ->setCellValue('I' . $contador, $data->tipo_servicio)
                        ->setCellValue('J' . $contador, $data->tipo_procedimiento)
                        ->setCellValue('K' . $contador, $data->fecha_programada)
                        ->setCellValue('L' . $contador, $data->observacion)
                        ->setCellValue('M' . $contador, $data->id_procedimiento)
                        ->setCellValue('N' . $contador, $data->estado_procedimiento);
                $contador++;
            }

            $writer = new PHPExcel_Writer_Excel2007($this->phpexcel);
            $writer->setPreCalculateFormulas(false);
            $writer->save($ruta . $nombre);
        }
        $data_return['url_descarga'] = $ruta_anchor . $nombre;
        $data_return ['nombre'] = '';
        $return["vista"] = $this->load->view('consultas/resultado', $data_return, true, false);
        echo json_encode($return);
    }    
    function obtener_mantenimientos_ejecutados($estado) {
        $this->load->library('PHPExcel');

        $datos_mantenimiento = $this->Consultas_model->obtener_mantenimientos($estado);
        $ruta = BASEPATH . '../tmp/';
        $ruta_anchor = base_url() . 'tmp/';
        $nombre = 'procedimientos_ejecutados' . date('d-m-y_h_i_s_A') . '_' . $this->ion_auth->user()->row()->username . '.xlsx';
        if ($datos_mantenimiento == false) {
            $data_return['resultado'] = 0;
        } else {
            $data_return ['resultado'] = 1;
            $cacheMethod = PHPExcel_CachedObjectStorageFactory:: cache_to_memcache;
            $cacheSettings = array('memoryCacheSize' => '1024MB');
            PHPExcel_Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);
            $objPHPExcel = $this->phpexcel->getActiveSheet();
            $this->phpexcel->getProperties()->setCreator("Equipo Laboratorio");
            $this->phpexcel->getProperties()->setTitle("Inventario");
            $objPHPExcel->getDefaultColumnDimension()->setWidth(20);
            $objPHPExcel->getDefaultRowDimension()->setRowHeight(15);
            $objPHPExcel->getStyle('A1:P1')->getFill()
                    ->setFillType(PHPExcel_Style_Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('002e6c');
            $objPHPExcel->getStyle('A1:P1')->getFont()->getColor()->setARGB('FFFFFFFF');
            $objPHPExcel->setCellValue('A1', 'NOMBRE');
            $objPHPExcel->setCellValue('B1', 'MARCA');
            $objPHPExcel->setCellValue('C1', 'MODELO');
            $objPHPExcel->setCellValue('D1', 'SERIE');
            $objPHPExcel->setCellValue('E1', 'PLACA');
            $objPHPExcel->setCellValue('F1', 'SEDE');
            $objPHPExcel->setCellValue('G1', 'UBICACION');
            $objPHPExcel->setCellValue('H1', 'PLANEACION MANTENIMIENTO');
            $objPHPExcel->setCellValue('I1', 'TIPO SERVICIO');
            $objPHPExcel->setCellValue('J1', 'TIPO PROCEDIMIENTO');
            $objPHPExcel->setCellValue('K1', 'FECHA PROGRAMADA');
            $objPHPExcel->setCellValue('L1', 'OBSERVACION APERTURA');
            $objPHPExcel->setCellValue('M1', 'FECHA EJECUCION');
            $objPHPExcel->setCellValue('N1', 'OBSERVACION CIERRE');
            $objPHPExcel->setCellValue('O1', 'ID_PROCEDIMIENTO');
            $objPHPExcel->setCellValue('P1', 'ESTADO_PROCEDIMIENTO');
            $contador = 2;
            foreach ($datos_mantenimiento->result_object() as $data) {
                $objPHPExcel->setCellValue('A' . $contador, $data->nombre_equipo)
                        ->setCellValue('B' . $contador, $data->marca)
                        ->setCellValue('C' . $contador, $data->modelo)
                        ->setCellValue('D' . $contador, $data->no_serie)
                        ->setCellValue('E' . $contador, $data->placa_inventario)
                        ->setCellValue('F' . $contador, $data->sede)
                        ->setCellValue('G' . $contador, $data->ubicacion)
                        ->setCellValue('H' . $contador, $data->mantenimiento)
                        ->setCellValue('I' . $contador, $data->tipo_servicio)
                        ->setCellValue('J' . $contador, $data->tipo_procedimiento)
                        ->setCellValue('K' . $contador, $data->fecha_programada)
                        ->setCellValue('L' . $contador, $data->observacion)
                        ->setCellValue('M' . $contador, $data->fecha_ejecucion)
                        ->setCellValue('N' . $contador, $data->observacion_cierre)
                        ->setCellValue('O' . $contador, $data->id_procedimiento)
                        ->setCellValue('P' . $contador, $data->estado_procedimiento);
                $contador++;
            }

            $writer = new PHPExcel_Writer_Excel2007($this->phpexcel);
            $writer->setPreCalculateFormulas(false);
            $writer->save($ruta . $nombre);
        }
        $data_return['url_descarga'] = $ruta_anchor . $nombre;
        $data_return ['nombre'] = '';
        $return["vista"] = $this->load->view('consultas/resultado', $data_return, true, false);
        echo json_encode($return);
    }   

}
