<?php

class Files_model extends CI_Model {

	function __construct() 
	{ 
		parent::__construct(); 
	}

	public function getImages($product_id)
	{
		$q = "SELECT *
			FROM products_images
			WHERE product_id = '$product_id'";

		$query = $this->db->query($q);
		$result = $query->result();

		/*foreach ($result as $each_image) {
			$img_name[] = $each_image->img_name;
		}
		var_dump($result);exit;*/
		return $result;
	}

	public function addImage($product_id, $img_names)
	{
		/*$q = "DELETE FROM products_images WHERE product_id = '{$product_id}'";
		$this->db->query($q);*/

		foreach ($img_names as $img_name) {
			$q_image_name = "INSERT INTO products_images (
							product_id, 
							img_name
							) 
						VALUES (
							'{$product_id}', 
							'{$img_name}'
						)";
			$query = $this->db->query($q_image_name);
		}
		return true;
	}

	public function deleteImage($row_id)
	{
		$q = "SELECT product_id FROM products_images WHERE id = '$row_id'";

		$query = $this->db->query($q);
		$result = $query->row();

		$q = "DELETE FROM products_images WHERE id = '{$row_id}'";
		$this->db->query($q);

		return $result;
	}
}