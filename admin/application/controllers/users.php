<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	function __construct() 
	{  
		parent::__construct();

		$is_logged_in = $this->users_model->isLoggedIn();

		$task = $this->uri->segment(2);

		if ($is_logged_in && $task != 'logout') {
			redirect('products');
		}
	}

	public function index()
	{
		$this->login();
	}

	public function login()
	{
		$post = $this->input->post();

		if ($post) {
			$is_valid = $this->validation_for_login();

			if ($is_valid) {
				$user = $this->users_model->authentication($post);

				if ($user) {
					$this->session->set_userdata('user_id', $user->id);

					redirect('products');
				}

				$data['authentication_error'] = 'Email или имя пользователя или пароль введены не правильно';
			}
		}

		$data['do_not_display_menu'] = true;
		$data['page'] = 'users/login';
		$this->load->view('main_tpl', $data);
	}


	public function logout()
	{
		delete_cookie('ci_session');
		$this->session->sess_destroy();
		
		redirect('users');
	}

	public function validation_for_login()
	{
		$this->form_validation->set_rules('email_or_username', 'Email или имя пользователя', 'required'); 
		$this->form_validation->set_rules('password', 'Пароль', 'required');

		if ($this->form_validation->run()) {
			return true;
		}

		return false;
	}

	public function validation_for_resetpass()
	{
		$this->form_validation->set_rules('password', 'Пароль', 'min_length[8]|callback_password_check');
		$this->form_validation->set_rules('password_confirm', 'Подтверждение пароля', 'matches[password]');

		if ($this->form_validation->run()) {
			return true;
		}

		return false;
	}

	public function password_check($str)
	{
	   if (preg_match('#[0-9]#', $str) && preg_match('#[A-Z]#', $str)) {
	     	return true;
	   }
	   $this->form_validation->set_message('password_check', 'Поле {field} должно содержать минимум одну цифру и одну заглавную латинскую букву');
	   return false;
	}

	public function accept_checkbox_check($post)
	{
	   if (!$post['accept_checkbox']) {
		   $this->form_validation->set_message('accept_checkbox_check', 'Необходимо согласиться с условиями пользования магазином');
		     return false;
	   }
	   return true;
	}

	public function validation_for_registration($post)
	{//name, lable, rules 
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]'); 
		$this->form_validation->set_rules('password', 'Пароль', 'min_length[8]|callback_password_check');
		$this->form_validation->set_rules('password_confirm', 'Подтверждение пароля', 'matches[password]');
		$this->form_validation->set_rules('username', 'Имя пользователя', 'required|is_unique[users.username]');
		$this->form_validation->set_rules('first_name', 'Имя', 'required');
		$this->form_validation->set_rules('last_name', 'Фамилия', 'required');
		$this->form_validation->set_rules('accept_checkbox', '', 'callback_accept_checkbox_check');

		if (isset($post['show-address-checkbox'])) {
			$this->form_validation->set_rules('city', 'Город', 'required');
			$this->form_validation->set_rules('street', 'Улица', 'required');
			$this->form_validation->set_rules('building', 'Номер дома', 'required');
		}

		if ($this->form_validation->run()) {
			$this->clear_session_user_data(); 
			return true;
		}

		return false;
	}

	public function registration()
	{
		$data['js_file'] = 'registration';
		$data['do_not_display_menu'] = 'do_not_display';
		
		$post = $this->input->post();
		$data['post'] = $post;

		$data['countries'] = $this->addresses_model->getCountry();
		$data['regions'] = $this->addresses_model->getRegion();

		if (!$post) {
			$this->session->unset_userdata('validation_errors');

			$data['page'] = 'users/registration';
			$this->load->view('main_tpl', $data);
			return;
		}

		$is_valid = $this->validation_for_registration($post);

		if ($is_valid) {
			$this->users_model->set_new_user($post);

			$new_user['new_user_login'] = 'Теперь можно войти, используя email или имя пользователя и пароль!';
			$this->session->set_userdata('new_user', $new_user);

			redirect('users/login');
		} 

		$data['page'] = 'users/registration';
		$this->load->view('main_tpl', $data);
	}

	public function restorepass()
	{
		$data['do_not_display_menu'] = 'do_not_display';
		$data['page'] = 'users/restorepass';
		$post = $this->input->post();

		if ($post) {
			$hashed_email = $this->users_model->checkEmail($post);

			if(!$hashed_email) {
				$data['error'] = 'Такой email не найден';
			} else {
				$url = base_url().'users/resetpass/'.$hashed_email;
				var_dump($url);exit;
				$data['message'] = 'Ссылка для сброса пароля была отправлена на указанный адресс';
				// TODO send email to user 
				$data['page'] = 'users/login';
			}
		}

		$this->load->view('main_tpl', $data);
	} 

	public function resetpass()
	{
		$this->clear_session_user_data(); 
		// TODO remoove expiried link from users_hash_data

		$data['do_not_display_menu'] = 'do_not_display';
		$data['page'] = 'users/changepass';
		$data['hashed_in_url_email'] = $this->uri->segment(3);
		$data['user_id'] = $this->users_model->get_hash_id($data['hashed_in_url_email']);

		if(!$data['user_id']) {
			$data['error'] = 'Время действия ссылки истекло';

			$data['page'] = 'users/login';
		}

		$this->load->view('main_tpl', $data);
	}

	public function changepass()
	{
		$hashed_in_url_email = $this->uri->segment(3);
		$user_id = $this->users_model->get_hash_id($hashed_in_url_email);

		if(!$user_id) {
			redirect('users/login');
		}

		$post = $this->input->post();

		$post['user_id'] = $user_id;

		$is_valid = $this->validation_for_resetpass($post);

		if (!$is_valid) {
			$data['do_not_display_menu'] = 'do_not_display';
			$data['hashed_in_url_email'] = $hashed_in_url_email;
			$data['user_id'] = $user_id;
			$data['page'] = 'users/changepass';
			$this->load->view('main_tpl', $data);
			return;
		}

		$this->users_model->changePassInTable($post);

		$new_password['new_password'] = 'Можно войти с новым паролем!';
		$this->session->set_userdata('new_password', $new_password);

		redirect('users/login');
	}

	public function clear_session_user_data()
	{
		$this->session->unset_userdata('validation_errors');
		$this->session->unset_userdata('post');		
	}
}