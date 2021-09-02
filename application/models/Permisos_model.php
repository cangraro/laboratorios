<?php

/*
 * this is an a extension to de ion auth model to manage the permisions by controller using
 * tables.
 * @author: Carlos Eduardo Jaramillo Londoño
 */
require_once APPPATH . '/libraries/JWT.php';

use \Firebase\JWT\JWT;

class Permisos_model extends CI_Model {

    function __construct() {
        parent::__construct();
        // $this->load->model('ion_auth_model');
    }

    function is_logged_in() {
        $headers = $this->input->get_request_header('Authorization');
        $jwt = str_replace('VM ', '', $headers);
        //print_r($this->input->request_headers());
        //echo $jwt;
        //die;
        $token = JWT::decode($jwt, 'ventasb2b2017*+', array('HS256'));
        //print_r($token);
        //firt we check the expiring time of the token later :P
        //second we check if the user has a session on the table.
        $this->db->select('*');
        $this->db->where('user', $token->login);
        $this->db->where('jwt', $jwt);
        $q = $this->db->get('api_sessions');
        if ($q->num_rows() >= 0) {
            //third we check if the user has permisions to do something in the controller
            //get groups
            $class = $this->router->class;
            // echo $class;
            //die;
            $this->db->select('id');
            $this->db->where('username', $token->login);
            $user = $this->db->get('users');

            if ($user->num_rows() >= 0) {
                $groups = $this->get_groups($user);
                foreach ($groups as $group) {
                    if ($this->check_permission($group->id, $class)) {
                        return true;
                    }
                }
            }


            // die;
            return false;
        } else {
            return false;
        }
    }

    public function create_api_session($user, $jwt) {
        $this->clear_api_session($user);
        $this->db->set('user', $user);
        $this->db->set('jwt', $jwt);
        $this->db->set('created_at', date("Y-m-d H:i:s"));
        $this->db->insert('api_sessions');
    }

    private function clear_api_session($user) {
        if ($user != null) {
            $this->db->where('user', $user);
            $this->db->delete('api_sessions');
        }
    }

    private function check_permission($gr_id, $class) {
        $this->db->select('cg.*');
        $this->db->where('cg.group_id', $gr_id);
        $this->db->where('c.descripcion', $class);
        $this->db->join('controller c', 'c.id=cg.controller_id', 'inner');
        $q = $this->db->get('group_controller cg');
        //echo $this->db->last_query();

        if ($q->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_permission() {
        //if user is admin don't check the group permissions
        if ($this->ion_auth->is_admin()) {
            return true;
        } else {

            $class = $this->router->class;
            // echo $class;
            //die;
            $groups = $this->get_groups();
            foreach ($groups as $group) {
                if ($this->check_permission($group->id, $class)) {
                    return true;
                }
            }
            // die;
            return false;
        }
    }

    private function get_groups($user = null) {
        if ($user == null) {
            $user = $this->ion_auth->user();
        }

        $user_groups = $this->ion_auth->get_users_groups($user->row()->id)->result();
        return $user_groups;
    }

    private function get_groups_arr() {
        $user = $this->ion_auth->user();
        $user_groups = $this->ion_auth->get_users_groups($user->row()->id)->result_array();
        return $user_groups;
    }

//administracion de controladores grupo

    function add_controller_group($idc, $idg) {
        $this->db->set('controller_id', $idc);
        $this->db->set('group_id', $idg);
        return $this->db->insert('group_controller');
    }

    function remove_controller_group($idc, $idg) {
        echo "remover";
        $this->db->where('controller_id', $idc);
        $this->db->where('group_id', $idg);
        return $this->db->delete('group_controller');
    }

    function add_controller_item($idm, $idg) {
        $this->db->set('menu_id', $idm);
        $this->db->set('group_id', $idg);
        return $this->db->insert('group_menu');
    }

    function remove_controller_item($idm, $idg) {
        echo "remover";
        $this->db->where('menu_id', $idm);
        $this->db->where('group_id', $idg);
        return $this->db->delete('group_menu');
    }

    function get_controllers_group($idg) {
        $this->db->select('g.name as nombre_grupo,g.id as id_grupo,cg.*');
        $this->db->join('group_controller cg', 'g.id=cg.group_id', 'left');
        $this->db->where('g.id', $idg);
        $this->db->from('groups g');
        $grupo_per = $this->db->get_compiled_select();


        $this->db->select('c.descripcion nombre,c.id as ctrl_id,gp.*');
        $this->db->join("($grupo_per) as gp", 'c.id=gp.controller_id', 'left');
        $this->db->order_by('c.descripcion');
        $q = $this->db->get('controller c');
        if ($q->num_rows() > 0) {
            return $q->result();
        } else {
            return false;
        }
    }

    function get_menu_group($idg) {

        $this->db->select('c.id as categoria, c.descripcion as categoria_nombre');
        $this->db->where('estado', 1);
        $categorias = $this->db->get('categoria_menu as c')->result();
        foreach ($categorias as $val) {
            $this->db->select('mi.id,m.id as id_permiso');
            $this->db->join('menu mi', 'mi.id=m.menu_id', 'left');
            $this->db->where('m.group_id', $idg);
            $this->db->from('group_menu m');
            $grupo_per = $this->db->get_compiled_select();
            $this->db->select('menu.descripcion nombre,menu.id as menu_id,gp.*');
            $this->db->join("($grupo_per) as gp", 'menu.id=gp.id', 'left');
            $this->db->where('menu.categoria_id', $val->categoria);
            $this->db->order_by('menu.descripcion');
            $val->items = $this->db->get('menu as menu')->result();
            //echo $this->db->last_query();
        }
        // print_r($categorias);
        return $categorias;
    }

    function obtener_permisos_menu() {
        $user = $this->ion_auth->user()->row();
        $admin = $this->ion_auth->is_admin();


        if (!$admin) {
            $groups = $this->get_groups();
            $gr = [];
            foreach ($groups as $group) {
                array_push($gr, $group->id);
            }
            $this->db->where_in('m.group_id', $gr);
        }

        $this->db->select('c.id, c.descripcion as nombre, m.group_id as permiso_id, c.icon');
        $this->db->join('group_menu as m', 'mi.id=m.menu_id', 'left');
        $this->db->join('categoria_menu as c', 'c.id=mi.categoria_id', 'inner');
        $this->db->from('menu as mi');
        $this->db->group_by('c.id');
        $this->db->order_by('c.id');

        $categorias = $this->db->get()->result();        
        foreach ($categorias as $val) {
            $this->db->select('mi.id,mi.descripcion nombre,mi.estado,mi.url,mi.icono icon,mi.categoria_id',false);
            $this->db->from('menu as mi');
            $this->db->join('group_menu as m', 'mi.id=m.menu_id', 'left');
            $this->db->where('mi.categoria_id', $val->id);
            $this->db->where('mi.estado', '1');
            $this->db->group_by('mi.id');
            if (!$admin) {
                $this->db->where_in('m.group_id', $gr);
            }            
            $val->menus = $this->db->get()->result();            
        }
        return $categorias;
    }
}