<?php

class Procedimientos_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function obtenerProcedimientos($where,$estado=null) {
        $this->db->select("p.id, p.fecha_programada,p.fecha_ejecucion,e.descripcion nombre_equipo,m.descripcion marca,
            e.modelo,e.no_serie,e.fecha_compra,e.placa_inventario,e.periodicidad_mantenimiento,e.voltaje,
            e.corriente,e.frecuencia,e.peso,e.largo,e.ancho,e.alto,e.observacion,e.rangos_id rango,p.observacion observacion_p,
            tp.descripcion tipo_procedimiento,ts.descripcion tipo_servicio,te.descripcion tipo_equipo,e.id_tipos_equipos,
            s.descripcion sede,u.descripcion ubicacion,p.estado,ep.descripcion estado_procedimiento,e.fecha_fin_garantia,
            concat_ws(' ',u1.first_name,u1.last_name) usuario_sol,concat_ws(' ',u2.first_name,u2.last_name) usuario_ejec,
            p.observacion_cierre,p.ruta_documento,year(p.fecha_ejecucion) ano,month(p.fecha_ejecucion) mes,day(p.fecha_ejecucion) dia", false);
        $this->db->from("procedimientos p");
        $this->db->join("equipos e", "e.id=p.id_equipo", "inner");
        $this->db->join("marcas m", "m.id=e.marcas_id", "inner");        
        $this->db->join("tipos_procedimientos tp", "tp.id=p.tipos_procedimientos_id", "inner");
        $this->db->join("tipo_servicios ts", "ts.id=p.tipo_servicios_id", "inner");
        $this->db->join("tipos_equipos te", "te.id=e.id_tipos_equipos", "inner");
        $this->db->join("ubicacion u", "u.id=e.ubicacion_id", "inner");
        $this->db->join("sedes s", "s.id=u.sedes_id", "inner");        
        $this->db->join("users u1", "u1.id=p.users_id_sol", "left");        
        $this->db->join("users u2", "u2.id=p.users_id_ejec", "left");        
        $this->db->join("estado_procedimientos ep", "ep.id=p.estado", "inner");        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        if(!is_null($estado)){
            $this->db->where_in("p.estado",$estado);
        }
        $this->db->where($key, $value);
        $this->db->order_by('p.fecha_programada', 'asc');
        
        $query = $this->db->get_compiled_select(); 
        
        return $this->db->query($query);
    }

    function obtenerAnsTipoServicio($where) {
        $this->db->select("ts.ans", false);
        $this->db->from("tipo_servicios ts");
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get_compiled_select();
        return $this->db->query($query);        
    }
    function obtenerActividades($where) {
        $this->db->select("a.id,a.descripcion", false);
        $this->db->from("actividades a");
        $this->db->where("a.estado", "1");
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->order_by('a.id', 'asc');
        $query = $this->db->get_compiled_select();
        return $this->db->query($query);
    }
    
    function obtenerActividadesProcedimiento($where){
        $this->db->select("ap.id,a.descripcion actividad,r.descripcion resultado",false  );
        $this->db->from("actividades_procedimientos ap");
        $this->db->join("actividades a","a.id=ap.id_actividad","inner");
        $this->db->join("resultados r","ap.id_resultado=r.id","inner");        
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get_compiled_select();
        return $this->db->query($query);
    }
    function obtener_procedimiento_equipo($where){
        $this->db->select("e.id,p.tipos_procedimientos_id,e.periodicidad_mantenimiento",false  );
        $this->db->from("procedimientos p");
        $this->db->join("equipos e", "e.id=p.id_equipo", "inner");       
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get_compiled_select();
        $resultado= $this->db->query($query);
        return $resultado->row();
    }    
    function obtenerRepuestosProcedimiento($where){
        $this->db->select("id,descripcion_repuesto,cantidad",false  );
        $this->db->from("repuestos_procedimientos r");       
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get_compiled_select();
        return $this->db->query($query);
    }
    
}