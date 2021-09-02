<?php

class Administracion_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function obtenerTablas($where = null) {
        $this->db->select("id,descripcion", false);
        $this->db->from("tablas");
        if ($where != null) {
            foreach ($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        $query = $this->db->get_compiled_select();
        $result = $this->db->query($query);
        if ($where != null) {
            return $result->row();
        } else {
            return $this->ordernarSelector($result->result_object());
        }
    }

    function ordernarSelector($objeto, $bool = true) {
        $arreglo = array();
        if ($bool) {
            $arreglo[''] = 'Seleccione una opción';
        }
        foreach ($objeto as $value) {
            $arreglo[$value->id] = $value->descripcion;
        }
        return $arreglo;
    }

    function insertar_selector($datos, $tabla) {
        $result = $this->db->insert($tabla, $datos);
        if ($result) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    function existe_selector($where, $tabla) {
        $this->db->select("id,descripcion", false);
        $this->db->from($tabla);
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->where("estado", "1");
        $query = $this->db->get_compiled_select();
        $result = $this->db->query($query);
        return $result->num_rows();
    }

    function obtenerSelectores($tabla, $bool = true) {
        $this->db->select("id,descripcion", false);
        $this->db->from($tabla);
        $this->db->where("estado", "1");
        $query = $this->db->get_compiled_select();
        $result = $this->db->query($query);
        return $this->ordernarSelector($result->result_object(), $bool);
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

    function obtenerCiudades($where) {
        $this->db->select("id,descripcion", false);
        $this->db->from("ciudades");
        $this->db->where("estado", "1");
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get_compiled_select();
        $result = $this->db->query($query);
        return $this->ordernarSelector($result->result_object(), false);
    }

    function actualizar_selector($datos, $where, $tabla) {
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

    function obtenerProtocolos($where) {
        $this->db->select("id,descripcion", false);
        $this->db->from("actividades");
        $this->db->where("estado", "1");
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get_compiled_select();        
        $result = $this->db->query($query);
        return $this->ordernarSelector($result->result_object(), false);
    }

}
