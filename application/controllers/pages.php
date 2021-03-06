<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller {

	public function __construct()
    {
    	parent::__construct();
    }
 
    public function index()
	{
		$data['filters'] = $this->input->get();

		$this->load->library('pagination');
		
		$this->config->load('pagination', TRUE);
		$config = $this->config->config['pagination'];
		$config['base_url'] = base_url() . 'pages/index';
		$total_row = $this->products_model->getCount($data['filters']);
		$config["total_rows"] = $total_row;
		$config['num_links'] = $total_row;
		$this->pagination->initialize($config);

		$page = 1;
		if(!empty($data['filters']['page'])){
			$page = $data['filters']['page'];
		}
		$products = $this->products_model->getAll($data['filters'], $config["per_page"], $page);

		$data['products'] = $this->categories_model->getProductCategories($products);

		$str_links = $this->pagination->create_links();

		$data["links"] = explode('&nbsp;', $str_links);

		$categories = $this->categories_model->getCategories();
		$data['categories'] = $this->prepareHtmlForCategoriesList($categories, 'parent_category');
		
		$data['page'] = 'content/products';
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

	public function product()
	{
		$categories = $this->categories_model->getCategories();
		$data['categories'] = $this->prepareHtmlForCategoriesList($categories, 'parent_category');
		$data['page'] = 'content/product';

		$this->load->view('main_tpl', $data);
	}

	public function about()
	{
		$categories = $this->categories_model->getCategories();
		$data['categories'] = $this->prepareHtmlForCategoriesList($categories, 'parent_category');
		$data['page'] = 'content/about';

		$this->load->view('main_tpl', $data);
	}

	public function contacts()
	{
		$categories = $this->categories_model->getCategories();
		$data['categories'] = $this->prepareHtmlForCategoriesList($categories, 'parent_category');
		$data['page'] = 'content/contacts';

		$this->load->view('main_tpl', $data);
	}
}