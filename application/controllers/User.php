<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("UserModel");
	}

	public function index()
	{
		$data['title']="Users- YTKaraoke";
		$this->load->view("layout/header",$data);
		$this->load->view("AdminPortal/user_page_view");
		$this->load->view("layout/footer");
	}
	public function AddUser()
	{
		$fields = array(
			'Email' => $this->input->post('Email'), 
			'Firstname' => $this->input->post('FirstName'), 
			'Lastname' => $this->input->post('LastName'),
			'Password' => $this->input->post('Email'),
		);
		$data['success']=$this->UserModel->Add($fields);
		echo json_encode($data);
	}
	public function GetUser()
	{
		$data['user']=$this->UserModel->Get();
		echo json_encode($data);
	}
	public function getUserByID($id)
	{
		$where = array('ID' => $id );
		$data['user']=$this->UserModel->getByID($where);
		echo json_encode($data);
	}
	public function UpdateUser()
	{
		$where = array('ID' => $this->input->post('ID'));
		$fields = array(
			'Email' => $this->input->post('Email'),
			'Firstname' => $this->input->post('FirstName'), 
			'Lastname' => $this->input->post('LastName')
		);
		$data['success']=$this->UserModel->Update($where,$fields);
		echo json_encode($data);
	}
	public function DeleteUser($id)
	{
		$where = array('ID' => $id );
		$data['success']=$this->UserModel->Delete($where);
		echo json_encode($data);
	}
}

/* End of file User.php */
/* Location: ./application/controllers/User.php */