<?php

class Consultas_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function obtener_inventario(){
        $this->db->select("e.descripcion nombre_equipo,m.descripcion marca,e.modelo,e.no_serie,e.placa_inventario,
                s.descripcion sede,u.descripcion ubicacion,concat_ws(' ',e.periodicidad_mantenimiento,' meses') mantenimiento,
                e.id_manuales,e.observacion",false);
        $this->db->from("equipos e");
        $this->db->join("marcas m","m.id=e.marcas_id","inner");
        $this->db->join("ubicacion u","u.id=e.ubicacion_id","inner");
        $this->db->join("sedes s","s.id=u.sedes_id","inner");
        $this->db->where("e.estado","1");
        $query=$this->db->get_compiled_select();
        return $this->db->query($query);
    }
    
    function obtener_mantenimientos($estado){
        if($estado[0]=="1"){
            $this->db->select("p.id id_procedimiento,ep.descripcion estado_procedimiento,e.descripcion nombre_equipo,m.descripcion marca,e.modelo,e.no_serie,e.placa_inventario,
            s.descripcion sede,u.descripcion ubicacion,concat_ws(' ',e.periodicidad_mantenimiento,' meses') mantenimiento,
            ts.descripcion tipo_servicio,tp.descripcion tipo_procedimiento,p.fecha_programada,p.observacion",false);
        }else{
            $this->db->select("p.id id_procedimiento,ep.descripcion estado_procedimiento,e.descripcion nombre_equipo,m.descripcion marca,e.modelo,e.no_serie,e.placa_inventario,
            s.descripcion sede,u.descripcion ubicacion,concat_ws(' ',e.periodicidad_mantenimiento,' meses') mantenimiento,
            ts.descripcion tipo_servicio,tp.descripcion tipo_procedimiento,p.fecha_programada,p.fecha_ejecucion,p.observacion,
            p.observacion_cierre",false);
        }
        $this->db->from("equipos e");
        $this->db->join("marcas m","m.id=e.marcas_id","inner");
        $this->db->join("ubicacion u","u.id=e.ubicacion_id","inner");
        $this->db->join("sedes s","s.id=u.sedes_id","inner");
        $this->db->join("procedimientos p","p.id_equipo=e.id","inner");
        $this->db->join("tipo_servicios ts","ts.id=p.tipo_servicios_id","inner");
        $this->db->join("tipos_procedimientos tp","tp.id=p.tipos_procedimientos_id","inner");
        $this->db->join("estado_procedimientos ep","ep.id=p.estado","inner");
        $this->db->where("e.estado",'1');
        $this->db->where_in("p.estado",$estado);
        $query=$this->db->get_compiled_select();
        return $this->db->query($query);
    }
    

}
