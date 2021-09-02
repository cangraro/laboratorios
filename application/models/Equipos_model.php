<?php

class Equipos_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Administracion_model');
    }

    function obtenerEquipos($where) {
        $this->db->select("e.id,e.descripcion,e.modelo,e.marcas_id,e.ubicacion_id,e.no_serie,e.fecha_compra,e.placa_inventario,"
                . "e.periodicidad_mantenimiento,e.voltaje,e.corriente,e.frecuencia,e.peso,e.largo,e.ancho,e.alto,e.rangos_id,"
                . "e.observacion,e.ubicacion_foto,e.fecha_fin_garantia,u.sedes_id,e.id_tipos_equipos,tp.descripcion tipo_equipo,"
                . "m.descripcion marca,s.descripcion sede,u.descripcion ubicacion,e.id_proveedor,"
                . "pro.nombre_cliente,pro.telefono,pro.celular,pro.email,pro.direccion,ciu.descripcion ciudad,dep.descripcion departamento,"
                . "IF(pro.tipo_documento not in ('2','4'),CONCAT(pro.documento,' - ',pro.digito_verificacion), pro.documento) as documento,"
                . "e.id_manuales,e.estado,e.ubicacion_guia,e.ubicacion_documentacion_legal", false);
        $this->db->from("equipos e");
        $this->db->join("ubicacion u", "u.id=e.ubicacion_id", "inner");
        $this->db->join("tipos_equipos tp", "tp.id=e.id_tipos_equipos", "inner");
        $this->db->join("marcas m", "m.id=e.marcas_id", "inner");
        $this->db->join("sedes s", "s.id=u.sedes_id", "inner");        
        $this->db->join("proveedores pro", "pro.id=e.id_proveedor", "inner");
        $this->db->join("ciudades ciu", "ciu.id=pro.ciudad_id", "inner");
        $this->db->join("departamentos dep", "dep.id=ciu.id_departamento", "inner");
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get_compiled_select();        
        return $this->db->query($query);
    }

    function obtenerSelectores($tabla) {
        $this->db->select("id,descripcion", false);
        $this->db->from($tabla);
        $this->db->where("estado", "1");
        $query = $this->db->get_compiled_select();
        $result = $this->db->query($query);
        return $this->Administracion_model->ordernarSelector($result->result_object(), true);
    }
    
    function obtenerProveedores() {
        $this->db->select("id,nombre_cliente descripcion", false);
        $this->db->from("proveedores");        
        $query = $this->db->get_compiled_select();
        $result = $this->db->query($query);
        return $this->Administracion_model->ordernarSelector($result->result_object(), true);
    }

    function insertar_registro($datos, $tabla) {
        $result = $this->db->insert($tabla, $datos);
        if ($result) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function actualizar_registro($datos, $where, $tabla) {
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $result = $this->db->update($tabla, $datos);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    function obtenerSedes($where) {
        $this->db->select("id,descripcion", false);
        $this->db->from("ubicacion");
        $this->db->where("estado", "1");
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get_compiled_select();
        $result = $this->db->query($query);
        return $this->ordernarSelector($result->result_object(), false);
    }

}
