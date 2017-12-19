<?php

class Products_categories_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

	public function insert($categories, $product_id)
	{
		//var_dump($categories);
		//var_dump($product_id);exit;
		$q = "DELETE FROM products_categories WHERE product_id = '{$product_id}'";
		$this->db->query($q);
		
		foreach ($categories as $category_id) {
			$q_category_id = "INSERT INTO products_categories (
							product_id, 
							category_id
							) 
						VALUES (
							'{$product_id}', 
							'{$category_id}'
						)";
			$query = $this->db->query($q_category_id);
		}
		return true;
	}

	function delete($id)
	{
		$q = "DELETE FROM products_categories WHERE product_id = '{$id}'";
		$this->db->query($q);

		return true;
	}
}