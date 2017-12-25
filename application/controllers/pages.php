<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
    }
 
    public function index()
	{
		$categories = $this->categories_model->getCategories();
		$data['categories'] = $this->prepareHtmlForCategoriesList($categories, 'parent_category');
	
		$data['page'] = 'content/default';
		$this->load->view('main_tpl', $data);
	}

	public function prepareHtmlForCategoriesList($categories, $class_name)
	{	
		$html = '<ul class="list-group '.$class_name.'">';
		
		foreach ($categories as $category) {
				$html .= '<a class="categories-list" href="#"><li style="text-decoration: none;">'. $category['title'] . '</li></a>';
			if (count($category['child_categories'])) {
				$html .= $this->prepareHtmlForCategoriesList($category['child_categories'], 'child_category');
			}
		}
		$html .= '</ul>';
		
		return $html;
	}

	public function product()
	{
		$categories = $this->categories_model->getCategories();
		$data['categories'] = $this->prepareHtmlForCategoriesList($categories, 'parent_category');
		$data['page'] = 'content/product';

		$this->load->view('main_tpl', $data);
	}
}