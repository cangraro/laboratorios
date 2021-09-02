<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Administracion extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('ion_auth');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->helper('captcha');
        $this->load->model('Administracion_model');
    }

    function selectores() {
        if ($this->ion_auth->logged_in()) {
            log_message('debug', 'sigue logueado');            
            $this->data['tablas']= $this->Administracion_model->obtenerTablas();
            $this->data['selectores']= array(""=>"Seleccione una opción");
            $this->data['template'] = 'administracion/selectores';            
            $this->load->view('template/template', $this->data);
        }else{
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
           
    }
    
    function crear_selector(){
        $where['id']=$this->input->post("tablas");
        $data["descripcion"]=$this->input->post("selector");        
        $data["estado"]='1';        
        $tabla=$this->Administracion_model->obtenerTablas($where);        
        if($this->Administracion_model->existe_selector($data,$tabla->descripcion)==0){
            $this->Administracion_model->insertar_selector($data,$tabla->descripcion);
            $retorno['mensaje']='Se creo el selector con exito!';
            $retorno['respuesta']=true;
        }else{
            $retorno['mensaje']='El selector no se creo, ya existe!';
            $retorno['respuesta']=false;
        }
        echo json_encode($retorno);
        
    }
    function obtener_selectores(){
        $where['id']=$this->input->post("tablas");
        $tabla=$this->Administracion_model->obtenerTablas($where);
        if($tabla!=null){
            $arreglo=$this->Administracion_model->obtenerSelectores($tabla->descripcion,false);
        }else{
            $arreglo=array();
        }        
        $selector='<option value="" selected="selected">Seleccione una opción</option>';
        foreach($arreglo as $key=>$value){
            $selector=$selector.'<option value="'.$key.'">'.$value.'</option>';
        }
        echo json_encode($selector);        
    }
    
    function obtener_ubicaciones(){
             
        if($this->input->post("sede")!=''){
            $where['sedes_id']=$this->input->post("sede");            
            $arreglo=$this->Administracion_model->obtenerSedes($where);
        }else{
            $arreglo=array();
        }        
        $selector='<option value="" selected="selected">Seleccione una opción</option>';
        foreach($arreglo as $key=>$value){
            $selector=$selector.'<option value="'.$key.'">'.$value.'</option>';
        }
        echo json_encode($selector);        
    }
    
    function inactivar_selector(){
        $where['id']=$this->input->post("tablas");
        
        $data['estado']=0;
        $tabla=$this->Administracion_model->obtenerTablas($where);
        $whereS['id']=$this->input->post("selector");
        if($this->Administracion_model->actualizar_selector($data,$whereS,$tabla->descripcion)){            
            $retorno['mensaje']='Se inactivo el selector con exito!';
            $retorno['respuesta']=true;
        }else{
            $retorno['mensaje']='El selector no existe o esta inactivo';
            $retorno['respuesta']=false;
        }
        echo json_encode($retorno);
        
    }
    
    function inactivar_sede(){
        $where['sedes_id']=$this->input->post("sede");
        $where['id']=$this->input->post("ubicacion");
        $data['estado']=0;              
        if($this->Administracion_model->actualizar_selector($data,$where,'ubicacion')){            
            $retorno['mensaje']='Se inactivo la sede con exito!';
            $retorno['respuesta']=true;
        }else{
            $retorno['mensaje']='La sede no existe o esta inactiva';
            $retorno['respuesta']=false;
        }
        echo json_encode($retorno);
        
    }
    
    function sedes(){
        if ($this->ion_auth->logged_in()) {
            log_message('debug', 'sigue logueado');            
            $this->data['sedes']= $this->Administracion_model->obtenerSelectores("sedes",true);            
            $this->data['ubicaciones']= array(""=>"Seleccione una opción");
            $this->data['template'] = 'administracion/sedes';            
            $this->load->view('template/template', $this->data);
        }else{
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }
    
    function crear_sedes(){
        $data["sedes_id"]=$this->input->post("sede");
        $data["descripcion"]=$this->input->post("ubicacion");        
        $data["estado"]='1';                     
        if($this->Administracion_model->existe_selector($data,'ubicacion')==0){
            $this->Administracion_model->insertar_selector($data,'ubicacion');
            $retorno['mensaje']='Se creo la sede con exito!';
            $retorno['respuesta']=true;
        }else{
            $retorno['mensaje']='La sede no se creo, ya existe!';
            $retorno['respuesta']=false;
        }
        echo json_encode($retorno);
        
    }
    
    function protocolos(){
        if ($this->ion_auth->logged_in()) {
            log_message('debug', 'sigue logueado');            
            $this->data['tipos_equipos']= $this->Administracion_model->obtenerSelectores("tipos_equipos",true);            
            $this->data['protocolos']= array(""=>"Seleccione una opción");
            $this->data['template'] = 'administracion/protocolos';            
            $this->load->view('template/template', $this->data);
        }else{
            $this->session->set_flashdata('error', 'No tienes permiso para usar este componente.');
            redirect();
        }
    }
    
    function obtener_protocolos(){
             
        if($this->input->post("tipo_equipo")!=''){
            $where['id_tipos_equipos']=$this->input->post("tipo_equipo");                                   
            $arreglo=$this->Administracion_model->obtenerProtocolos($where);
        }else{
            $arreglo=array();
        }        
        $selector='<option value="" selected="selected">Seleccione una opción</option>';
        foreach($arreglo as $key=>$value){
            $selector=$selector.'<option value="'.$key.'">'.$value.'</option>';
        }
        echo json_encode($selector);        
    }
    
    function crear_protocolo(){
        $data["id_tipos_equipos"]=$this->input->post("tipo_equipo");
        $data["descripcion"]=$this->input->post("protocolo");        
        $data["estado"]='1';                     
        if($this->Administracion_model->existe_selector($data,'actividades')==0){
            $this->Administracion_model->insertar_selector($data,'actividades');
            $retorno['mensaje']='Se creo el protocolo con exito!';
            $retorno['respuesta']=true;
        }else{
            $retorno['mensaje']='El protocolo no se creo, ya existe!';
            $retorno['respuesta']=false;
        }
        echo json_encode($retorno);
        
    }
    
    function inactivar_protocolo(){
        $where['id_tipos_equipos']=$this->input->post("tipo_equipo");
        $where['id']=$this->input->post("protocolo");
        $data['estado']=0;              
        if($this->Administracion_model->actualizar_selector($data,$where,'actividades')){            
            $retorno['mensaje']='Se inactivo el protocolo con exito!';
            $retorno['respuesta']=true;
        }else{
            $retorno['mensaje']='El protocolo no existe o esta inactivo';
            $retorno['respuesta']=false;
        }
        echo json_encode($retorno);
        
    }

}
