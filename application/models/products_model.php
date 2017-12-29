<?php

class Products_model extends CI_Model {

	private $category_ids = array();

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

    function getCount($filters)
	{
		$q = "SELECT COUNT(*) AS items_count
			FROM products 
			WHERE ";

		$q .= implode(' OR ', $this->getFilters($filters));
		
		$query = $this->db->query($q);
		$result = $query->row(); 

		return $result->items_count;
	}

    function getLastPageForProdocts($filters)
	{
		$q = "SELECT COUNT(*) AS items_count
			FROM products 
			WHERE 1";
 
		$query = $this->db->query($q);
		$result = $query->row();

		$items_per_page = $this->config->item('items_per_page');

		$last_page = ceil($result->items_count / $items_per_page);

		return $last_page;
	}

	public function getFilters($filters)
	{
		$where_params = array('1');

		if (!empty($filters['q'])) {
			$where_params = array();
			$where_params[] = "products.title LIKE '%{$filters['q']}%'";
			$where_params[] = "products.description LIKE '%{$filters['q']}%'";
			$where_params[] = "products.short_description LIKE '%{$filters['q']}%'";
			$where_params[] = "products.vendor_code LIKE '%{$filters['q']}%'";
		}

		return $where_params;
	}

	public function getAll($filters, $items_per_page, $page)
	{
		$offset = ($page - 1) * $items_per_page;

		$q = "SELECT *, products.id as id
			FROM products
			LEFT JOIN products_images ON products.id = products_images.product_id 
			WHERE ";

		$q .= implode(' OR ', $this->getFilters($filters));

		$q .= " GROUP BY products.id";

		$q .= " LIMIT {$offset}, {$items_per_page}";

		$query = $this->db->query($q);
		$result = $query->result();

		return $result;
	}

	public function addProduct($post)
	{
		$q = "INSERT INTO products (
			title, 
			description, 
			short_description, 
			price, 
			sale_percent,
			sale_price,
			vendor_code, 
			is_available 
			) 
		VALUES (
			'{$post['title']}', 
			'{$post['description']}', 
			'{$post['short_description']}', 
			'{$post['price']}',
			'{$post['sale_percent']}', 
			'{$post['sale_price']}', 
			'{$post['vendor_code']}', 
			'{$post['is_available']}' 
		)";

		$this->db->query($q);

		$q_get_last_id = "SELECT LAST_INSERT_ID() AS lastid FROM products";
		$query = $this->db->query($q_get_last_id);
		$result = $query->row();

		$this->products_categories_model->insert($post['categories'], $result->lastid);

		$this->files_model->addImage($result->lastid, $post['file_name']);

		return true;
	}

	function deleteProduct($id)
	{
		$q = "DELETE FROM products WHERE id = '{$id}'";
		$this->db->query($q);

		return true;
	}

	function getProduct($id)
	{
		$q = "SELECT *
			FROM products
			LEFT JOIN products_categories ON products.id = products_categories.product_id
			WHERE products.id = '{$id}'";

		$query = $this->db->query($q);
		$result = $query->row();
		//var_dump($result);exit;
		$result->images = $this->files_model->getImages($id);

		return $result;
	}

	public function changeProduct($post)
	{
		$this->files_model->addImage($post['id'], $post['file_names']);

		$this->products_categories_model->insert($post['categories'], $post['id']);

		$q = "UPDATE products 
			SET 
			title = '{$post['title']}',
			description = '{$post['description']}',
			short_description = '{$post['short_description']}',
			price = '{$post['price']}',
			sale_percent = '{$post['sale_percent']}', 
			sale_price = '{$post['sale_price']}', 
			vendor_code = '{$post['vendor_code']}', 
			is_available = '{$post['is_available']}'
			WHERE id = '{$post['id']}'
			";
		$this->db->query($q);

		return true;
	}

	function getIdOfChildCategories($parent_id)
	{
		$q = "SELECT id FROM categories WHERE parent_id = {$parent_id}";

		$query = $this->db->query($q);
		$categories = $query->result();

		foreach ($categories as $category) {
			$this->category_ids[] = $category->id;
			$this->getIdOfChildCategories($category->id);
		}
		return $this->category_ids;
	}

	function getProductsByCategories($parent_id)
	{
		$this->category_ids[] = $parent_id;

		$categories_id = implode(',', $this->getIdOfChildCategories($parent_id));

		$q = "SELECT *, products.id as id
			FROM products
			INNER JOIN products_categories ON products.id = products_categories.product_id
			LEFT JOIN products_images ON products.id = products_images.product_id 
			WHERE products_categories.category_id IN ({$categories_id}) 
			GROUP BY products.id";


		$query = $this->db->query($q);
		$result = $query->result();

		return $result;
	}

}