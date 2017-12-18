<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	public function __construct()
    {
		parent::__construct();

		$is_logged_in = $this->users_model->isLoggedIn();

		if (!$is_logged_in) {
			redirect('users');
		}
    }

	public function index()
	{
		$data['filters'] = $this->input->get();
		$this->load->library('pagination');

		$config = array();
		$config['base_url'] = base_url() . 'products/index';
		$total_row = $this->products_model->getCount($data['filters']);
		$config["total_rows"] = $total_row;
		$config["reuse_query_string"] = true;
		$config["page_query_string"] = true;
		$config["query_string_segment"] = 'page';
		$config["per_page"] = 5;
		$config['use_page_numbers'] = TRUE;
		$config['num_links'] = $total_row;
		$config['cur_tag_open'] = '&nbsp;<li><a class="current">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '&nbsp<li>';
		$config['num_tag_close'] = '&nbsp</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_link'] = 'Следущая страница';
		$config['prev_link'] = 'Предыдущая страница';

		$this->pagination->initialize($config);
		$page = 1;
		if(!empty($data['filters']['page'])){
			$page = $data['filters']['page'];
		}
		$products = $this->products_model->getAll($data['filters'], $config["per_page"], $page);

		$data['products'] = $this->categories_model->getProductCategories($products);

		$str_links = $this->pagination->create_links();
		$data["links"] = explode('&nbsp;',$str_links );

		$data['page'] = 'products/index';
		$this->load->view('main_tpl', $data);
	}

	public function deleteImage()
	{
		$id = $this->uri->segment(3);

		$result = $this->files_model->deleteImage($id);
		redirect('products/update/' . $result->product_id);
	}

	public function create()
	{
		$categories = $this->categories_model->getCategories();
		$data['html'] = $this->prepareHtmlForCategoriesCheckboxes($categories, 'parent_category', []);

		$data['js_file'] = 'products';
		$data['page'] = 'products/create';
		$this->load->view('main_tpl', $data);
	}

	public function add()
	{
		$post = $this->input->post();

		list($upload_error, $file_name) = $this->uploading();

		$is_valid = $this->validation($upload_error);

		if (!isset($post['categories'])) {
				$data['cat_error'] = 'Необходимо выбрать категорию';
				$is_valid = false;
			}

		if (!$is_valid) {
			$categories = $this->categories_model->getCategories();
			$data['html'] = $this->prepareHtmlForCategoriesCheckboxes($categories, 'parent_category', []);
			$data['upload_error'] = $upload_error;	
			$data['js_file'] = 'products';
			$data['page'] = 'products/create';
			$this->load->view('main_tpl', $data);
			return;
		}
		
		$post['file_name'] = $file_name;

		$this->products_model->addProduct($post);

		$last_page = $this->products_model->getLastPageForProdocts();
		redirect('products/index/' . $last_page);
	}

	public function uploading()
	{
		$config['upload_path'] = $this->config->item('upload_path');
		$config['allowed_types'] = 'gif|jpg|png';

		$this->load->library('upload', $config);

		$images = array();

		$files = $_FILES['userfile'];

		if (!$files['name']['0']) {
			return;
		}

        foreach ($files['name'] as $key => $image) {
            $_FILES['my_new_file']['name'] = $files['name'][$key];
            $_FILES['my_new_file']['type'] = $files['type'][$key];
            $_FILES['my_new_file']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['my_new_file']['error'] = $files['error'][$key];
            $_FILES['my_new_file']['size'] = $files['size'][$key];

            $img_type = explode('.', $image);

            $fileName = date('Y-m-d_H-i-s') . '.' . $img_type[1];

            $config['file_name'] = $fileName;

            $this->upload->initialize($config);

            if (!$this->upload->do_upload('my_new_file'))
			{
				$error = $this->upload->display_errors();
				return [$error, null];
			}
			$data = $this->upload->data();
			$images[] = $data['file_name'];
        }

        return [null, $images];		
	}

	public function update() 
	{
		$id = $this->uri->segment(3);
		$data['product'] = $this->products_model->getProduct($id);

		$categories = $this->categories_model->getCategories();
		$product_cat = $this->categories_model->getProductCategoriesInUpdate($data['product']);
		$data['html'] = $this->prepareHtmlForCategoriesCheckboxes($categories, 'parent_category', $product_cat);
		$data['js_file'] = 'products';
		$data['page'] = 'products/update';
		$this->load->view('main_tpl', $data);
	}

	public function change()
	{
		$post = $this->input->post();
		$id = $post['id'];

		$data['product'] = $this->products_model->getProduct($id);
		list($upload_error, $file_names) = $this->uploading();

		$categories = $this->categories_model->getCategories();
		$product_cat = $this->categories_model->getProductCategoriesInUpdate($data['product']);
		$data['html'] = $this->prepareHtmlForCategoriesCheckboxes($categories, 'parent_category', $product_cat);

		$is_valid = $this->validation($upload_error);

		if (!isset($post['categories'])) {
				$data['cat_error'] = 'Необходимо выбрать категорию';
				$is_valid = false;
			}

		if (!$is_valid) {
			$id = $post['id'];
			$data['post'] = $post;
			$data['upload_error'] = $upload_error;
			$data['js_file'] = 'products';
			$data['page'] = 'products/update';
			$this->load->view('main_tpl', $data);
			return;
		}

		$post['file_names'] = $file_names;

		$this->products_model->changeProduct($post);
		redirect('products');
	}

	public function prepareHtmlForCategoriesCheckboxes($categories, $class_name, $product_cat)
	{
		$checked = '';
		$html = '<ul class="'.$class_name.'">';
		foreach ($categories as $category) {

			foreach ($product_cat as $each_cat) {
				if ($each_cat == $category['id'])
					$checked = 'checked';
			}

			$html .= '<li><label><input ' . $checked . ' name="categories[]" value="' . $category['id'] . '" type="checkbox">' . $category['title'] . '</label></li>'; 
			$checked = '';
			if (count($category['child_categories'])) {
				$html .= $this->prepareHtmlForCategoriesCheckboxes($category['child_categories'], 'child_category', $product_cat);
			}
		}
		$html .= '</ul>';
		return $html;
	}

	public function validation($upload_error)
	{	
		$this->form_validation->set_rules('title', 'Название', 'required');
		$this->form_validation->set_rules('description', 'Описание', 'required');
		$this->form_validation->set_rules('short_description', 'Краткое описание', 'required');
		$this->form_validation->set_rules('price', 'Цена', 'required');
		$this->form_validation->set_rules('vendor_code', 'Артикул', 'required');
		//$this->form_validation->set_rules('is_available', 'Наличие на складе', 'callback_is_available_check');

		if ($this->form_validation->run() && !$upload_error) {
			return true;
		}

		return false;
	}

	public function is_available_check($post)
	{
	   if (!isset($post)) {
		   $this->form_validation->set_message('is_available_check', 'Товар в наличии?');
		    return false;
	   }
	   return true;
	}

	public function delete()
	{
		$id = $this->uri->segment(3);
		$this->products_model->deleteProduct($id);
		$this->products_categories_model->delete($id);

		redirect('products');
	}
	
}