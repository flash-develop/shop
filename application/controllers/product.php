<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
    }
 
    public function index()
	{
		$id = $this->uri->segment(2, 0);
		if (!$id) {
			redirect('pages');
		}

		$categories = $this->categories_model->getCategories();
		$data['categories'] = $this->prepareHtmlForCategoriesList($categories, 'parent_category');

		$data['product'] = $this->products_model->getProduct($id);

		$data['page'] = 'content/product';
		$this->load->view('main_tpl', $data);
	}

	public function prepareHtmlForCategoriesList($categories, $class_name)
	{	
		$html = '<ul class="list-group '.$class_name.'">';
		
		foreach ($categories as $category) {
				$html .= '<a class="categories-list" href="'. base_url() . 'categories/' . $category['id'] . '"><li style="text-decoration: none;">'. $category['title'] . '</li></a>';
			if (count($category['child_categories'])) {
				$html .= $this->prepareHtmlForCategoriesList($category['child_categories'], 'child_category');
			}
		}
		$html .= '</ul>';
		
		return $html;
	}
}