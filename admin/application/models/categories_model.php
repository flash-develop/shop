<?php

class Categories_model extends CI_Model {

	function __construct() 
	{ 
		parent::__construct(); 
	}

	public function getCategory($id) {

		$q = "
			SELECT * 
			FROM categories
			WHERE id = '{$id}'
		";

		$query = $this->db->query($q);
		$result = $query->row();
		return $result;
	}

	public function getProductCategories($products)
	{
		foreach ($products as $key => $each_product) {
			$q = "SELECT * 
			FROM products_categories
			LEFT JOIN categories ON products_categories.category_id = categories.id 
			WHERE product_id = '{$each_product->product_id}'";

			$query = $this->db->query($q);
			$products[$key]->categories = $query->result();
		}
		return $products;
	}

	public function getCategories($parent_id = '') { //default values
		$where = 'parent_id IS NULL';
		if ($parent_id) {
			$where = "parent_id = '{$parent_id}'";
		}

		$q = "SELECT * FROM categories WHERE {$where}";

		$query = $this->db->query($q);
		$result = $query->result();

		$categories = array();

		foreach ($result as $parent_category) {
			$category = array();

			$category['id'] 		 = $parent_category->id;
			$category['title'] 		 = $parent_category->title;
			$category['description'] = $parent_category->description;
			$category['parent_id']	 = $parent_category->parent_id;	

			$category['child_categories'] = $this->getCategories($parent_category->id);

			$categories[$parent_category->id] = $category; 			
		}
		return $categories;
	}

	function delete($id)
	{
		$q = "DELETE FROM categories WHERE id = '{$id}'";
		$this->db->query($q);
		return true;
	}


	function update($post)
	{

		$set = 'parent_id = DEFAULT';

		if ($post['parent_id']) {
			$set = "parent_id = '{$post['parent_id']}'";
		}

		$q = "UPDATE categories 
				SET 
				title = '{$post['title']}',
				description = '{$post['description']}',
				{$set}
				WHERE id = '{$post['category_id']}'
			";
		$this->db->query($q);
		return true;
	}

	function create($post)
	{
		$field = '';
		$value = '';

		if ($post['parent_id']) {
			$field = ', parent_id';
			$value = ', ' . $post['parent_id'];
		}

		$q = "
			INSERT INTO categories 
			(
				title,
				description
				{$field}
			)
			VALUES 
			(
				'{$post['title']}',
				'{$post['description']}'
				'{$value}'
			)
		";
		$this->db->query($q);
		return true;

		/*$par_id = "'{$post['parent_id']}'";
		$where = ", " . $par_id;

		if (!$post['parent_id']) {
			$where = '';
			$par_id = '';
		} else {
			$where = ', parent_id';
			$par_id = ", '{$post['parent_id']}'";
		}

		$q = "INSERT INTO categories (
				title,
				description
				{$where}
				)
				VALUES (
				'{$post['title']}',
				'{$post['description']}'
				{$par_id}
				)
				";
				var_dump($q);exit;*/
		
	}

}