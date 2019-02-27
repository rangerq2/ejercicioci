<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getUsers()
    {
        $query = $this->db->select('u.id, p.descripcion, u.nombre, u.apellido, u.email, u.telefono')
        ->from('usuario as u')
        ->join('perfil as p', 'p.id = u.id_perfil', 'inner')
        ->get();
        
        if ($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return false;
        }
    }

    public function addUser()
    {
        $field = array(
            'id_perfil' => $this->input->post('id_perfil'),
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'email' => $this->input->post('email'),
            'telefono' => $this->input->post('telefono')
        );

        $this->db->insert('usuario', $field);
        if ($this->db->affected_rows() > 0){
            return true;
        }
        else{
            return false;
        }
    }

    public function editUser()
    {
		$id = $this->input->get('id');
		$this->db->where('id', $id);
        $query = $this->db->get('usuario');
        
		if($query->num_rows() > 0){
			return $query->row();
        }
        else{
			return false;
		}
	}

    public function updateUser()
    {
		$id = $this->input->post('id');
		$field = array(
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'email' => $this->input->post('email'),
            'telefono' => $this->input->post('telefono'),
            'id_perfil' => $this->input->post('id_perfil')
		);
		$this->db->where('id', $id);
        $this->db->update('usuario', $field);
        
		if($this->db->affected_rows() > 0){
			return true;
        }
        else{
			return false;
		}
    }  
    
    function deleteUser()
    {
		$id = $this->input->get('id');
		$this->db->where('id', $id);
        $this->db->delete('usuario');
        
		if($this->db->affected_rows() > 0){
			return true;
        }
        else{
			return false;
		}
	}    
}
