<?php

class Proveedores_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('Administracion_model');
    }

    function obtenerProveedor($where) {
        $this->db->select("p.id,p.documento,p.nombre_cliente,p.ciudad_id,p.telefono,p.celular,p.email,p.digito_verificacion,
                c.descripcion ciudad,d.descripcion departamento,c.id_departamento,p.direccion,p.tipo_documento", false);
        $this->db->from("proveedores p");
        $this->db->join("ciudades c", "c.id=p.ciudad_id", "inner");
        $this->db->join("departamentos d", "d.id=c.id_departamento", "inner");
        $this->db->join("tipos_documentos td", "td.id=p.tipo_documento", "inner");
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get_compiled_select();        
        return $this->db->query($query);
    }

}
