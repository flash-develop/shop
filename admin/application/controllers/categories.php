<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

	private $html = '';

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
		$categories = $this->categories_model->getCategories();

		$data['html'] = $this->prepareHtmlForCategoriesList($categories, 'parent_category');

		$data['htmlSelect'] = $this->prepareHtmlForCategoriesSelect($categories);

		$data['page'] = 'categories/index';
		$this->load->view('main_tpl', $data);
	}

	public function prepareHtmlForCategoriesList($categories, $class_name)
	{	
		$html = '<ul class="'.$class_name.' list-group">';
		
		foreach ($categories as $category) {
			$glyphs = 	'<a cat_id="' . $category['id'] . '" class="color-black edit-category" href="#" style="text-decoration: none">
						<span class="glyphicon glyphicon-pencil"></span>
					</a>
					<a cat_id="' . $category['id'] . '" class="delete-category color-black" href="#" style="text-decoration: none">
						<span class="glyphicon glyphicon-remove"></span>
					</a>';
			$html .= '<li class="list-group-item">' . $category['title'] . $glyphs . '</li>'; 
			if (count($category['child_categories'])) {
				$html .= $this->prepareHtmlForCategoriesList($category['child_categories'], 'child_category');
			}
		}
		$html .= '</ul>';
		return $html;
	}

	public function prepareHtmlForCategoriesSelect($categories, $space = '')
	{	
		$html = '';
		$space .= '&nbsp&nbsp&nbsp';
		foreach ($categories as $category) {
	
			$html .= '<option value="' . $category['id'] . '">'. $space . $category['title'] . '</option>';
			if (count($category['child_categories'])) {
				$html .= $this->prepareHtmlForCategoriesSelect($category['child_categories'], $space);
			}
		}
		return $html;
	}

	public function ajaxRequestGetCategories()
	{
		$post = $this->input->post();

		$return_data = new stdClass();
		$return_data->category = $this->categories_model->getCategory($post['id']);
		echo json_encode($return_data); 
	}

	public function ajaxRequestDeleteCategory()
	{
		$post = $this->input->post();

		$success = $this->categories_model->delete($post['id']);

		$return_data = new stdClass();
		$return_data = $success;
		echo json_encode($return_data); 
	}

	public function update()
	{
		$post = $this->input->post();

		$this->categories_model->update($post);
		redirect('categories/index');
	}

	public function create()
	{
		$post = $this->input->post();

		$this->categories_model->create($post);
		redirect('categories/index');
	}
}




