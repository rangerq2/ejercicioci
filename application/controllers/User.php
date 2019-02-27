<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'u');
        $this->load->model('Profile_model', 'p');
    }

	public function index()
	{
        $data['get_profiles'] = $this->p->getProfiles();

        $this->load->view('layout/header');
        $this->load->view('user/index', $data);
        $this->load->view('layout/footer');
    }
    
    public function getUsers()
    {
        $result = $this->u->getUsers();
        echo json_encode($result);
    }

    public function addUser()
    {
        $result = $this->u->addUser();
        $msg['success'] = false;
        $msg['type'] = 'add';
        if ($result){
            $msg['success'] = true;
        }
        echo json_encode($msg);
    }

    public function editUser()
    {
		$result = $this->u->editUser();
		echo json_encode($result);
	}

    public function updateUser()
    {
		$result = $this->u->updateUser();
		$msg['success'] = false;
        $msg['type'] = 'update';
        
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
    }
    
    public function deleteUser()
    {
		$result = $this->u->deleteUser();
        $msg['success'] = false;
        
		if($result){
			$msg['success'] = true;
		}
		echo json_encode($msg);
	}    
}
