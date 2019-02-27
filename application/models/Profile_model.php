<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function getProfiles()
    {
        $query = $this->db->get('perfil');

        if ($query->num_rows() > 0){
            return $query->result();
        }
        else{
            return false;
        }
    }
}