<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NinjaGold extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->output->enable_profiler();

		$this->gold = $this->session->userdata('gold');
		$this->activities = $this->session->userdata('activities');
	}

	public function registration() {
		$this->load->view('login');
	}

	public function register() {

		$this->load->library("form_validation");
		$this->form_validation->set_rules("first_name", "First name", "trim|required");
		$this->form_validation->set_rules("last_name", "Last name", "trim|required");
		$this->form_validation->set_rules("email", "email", "trim|required|is_unique[users.email]|valid_email");
		$this->form_validation->set_rules("password", "Password", "trim|required|matches[confirm]|md5");
		$this->form_validation->set_rules("confirm", "Confirm Password", "trim|required|md5");

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/');
		}

		else {

			$this->load->model('loginmodel');
			$user_details = array(
				'firstname' => $this->input->post('first_name'),
				'lastname' => $this->input->post('last_name'),
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
				);

			$insert_info = $this->loginmodel->InsertInfo($user_details);
			redirect('/game');
	    }
	}

	public function login() {

		$this->load->library("form_validation");
		$this->form_validation->set_rules("email2", "email", "trim|required|valid_email");
		$this->form_validation->set_rules("password2", "Password", "trim|required");

		if($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('errors', validation_errors());
			redirect('/');
		}

		$email = $this->input->post('email2');
		$password = md5($this->input->post('password2'));
		$this->load->model('loginmodel');
		$user= $this->loginmodel->RetrieveInfo($email);

		if($user && $user['password'] == $password) {
			$logger = array(
				'user_id' => $user['id'],
				'user_email' => $user['email'],
				'user_name' => $user['first_name'].' '.$user['last_name'],
				'is_logged_in' => true);

			$this->session->set_userdata($logger);

			// $welcome = "Welcome"  . $user_details['firstname'] . ".";
			// $this->session->set_userdata('welcome', $welcome);
			redirect('/game');			
		}
    }

	public function index() {

		$activities = array();
		$this->session->set_userdata('activities', $activities);
		$this->load->view('ninjagold_index');
	}

	public function ProcessMoney() {

		$action = $this->input->post('action');
	
		if($action == 'farm') {
			$farmgold = rand(10,20);
			$tempgold = $this->session->userdata('gold');
			$this->session->set_userdata('gold', $tempgold+$farmgold);

			$activities = $this->session->userdata('activities');
			$activities[] = "<p>Earned " . $farmgold . " from the farm! (" . date('M d, Y h:ia') . ")</p>";
			$this->session->set_userdata('activities', $activities);
		}

		if($action == 'cave') {
			$cavegold = rand(5,10);
			$tempgold = $this->session->userdata('gold');
			$this->session->set_userdata('gold', $tempgold+$cavegold);

			$activities = $this->session->userdata('activities');
			$activities[] = "<p>Earned " . $cavegold . " from the cave! (" . date('M d, Y h:ia') . ")</p>";
			$this->session->set_userdata('activities', $activities);
		}

		if($action == 'house') {
			$housegold = rand(2,5);
			$tempgold = $this->session->userdata('gold');
			$this->session->set_userdata('gold', $tempgold+$housegold);

			$activities = $this->session->userdata('activities');
			$activities[] = "<p>Earned " . $housegold . " from the house! (" . date('M d, Y h:ia') . ")</p>";
			$this->session->set_userdata('activities', $activities);
		}

		if($action == 'casino') {
			$casinogold = rand(-50,50);
			$tempgold = $this->session->userdata('gold');
			$this->session->set_userdata('gold', $tempgold+$casinogold);

			if($tempgold < 0){
				$activities = $this->session->userdata('activities');
				$activities[] = "<p>Entered and lost " . $casinogold . " golds...OUCH! (" . date('M d, Y h:ia') . ")</p>";
				$this->session->set_userdata('activities', $activities);
			}

			if($tempgold > 0){
				$activities = $this->session->userdata('activities');
				$activities[] = "<p>Entered and gained " . $casinogold . " golds...Jackpot! (" . date('M d, Y h:ia') . ")</p>";
				$this->session->set_userdata('activities', $activities);
			}
		}

		$this->load->view('ninjagold_index');
    }

    public function game(){

    	$this->load->view('ninjagold_index');
    }

    public function reset() {

    	$this->session->sess_destroy();
    	redirect('/Ninjagold/index');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/');   
    }

}




























