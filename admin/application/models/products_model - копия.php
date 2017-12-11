<?php

class Products_model extends CI_Model {

	public function __construct()
    {
        parent::__construct();
        // Your own constructor code
    }

	/*public function getAll()
	{
		$q = "SELECT * 
			FROM products
			WHERE 1";
		
		$query = $this->db->query($q);
		$result = $query->result();

		foreach ($result as $item) {
			$test = $this->getCategories($item->id);
		}

		return $result;
	}*/

	public function getAll($product_id = '')
	{
		$q = "
			SELECT 
				COUNT(t_hand_histories.f_game_id) AS total_hands, 
				COUNT(DISTINCT t_hand_histories.f_table_id) AS total_tables,
				t_table.f_low_bet AS small_blind,
				t_table.f_high_bet AS big_blind,
				t_hand_histories.f_limit_type AS game_type,
				t_hand_histories.f_version_type AS limit_type
			FROM t_hand_histories 
			LEFT JOIN t_table ON t_hand_histories.f_table_id = t_table.f_id
			WHERE 1 
			GROUP BY 
				t_table.f_high_bet, 
				t_hand_histories.f_limit_type, 
				t_hand_histories.f_version_type
		";

		$q55 = "
			SELECT 
				COUNT(t_hand_histories.f_game_id) AS total_hands, 
				COUNT(DISTINCT t_hand_histories.f_table_id) AS total_tables,
				COUNT(t_participation.f_player_id) AS player,
				t_table.f_low_bet AS small_blind,
				t_table.f_high_bet AS big_blind,
				t_hand_histories.f_limit_type AS game_type,
				t_hand_histories.f_version_type AS limit_type
			FROM t_hand_histories 
			LEFT JOIN t_table ON t_hand_histories.f_table_id = t_table.f_id
			LEFT JOIN t_participation ON t_participation.f_game_id = t_hand_histories.f_game_id
			WHERE 1 
			GROUP BY 
				t_table.f_high_bet, 
				t_hand_histories.f_limit_type, 
				t_hand_histories.f_version_type,
		";

		$q5 = "
			SELECT 
				COUNT(players) AS player_count,
				COUNT(players3) AS player3_count3
					FROM (SELECT 
							COUNT(t_participation.f_player_id) AS players
						FROM t_participation
						GROUP BY
							t_participation.f_game_id
						HAVING
							players = 2) AS player
					INNER JOIN (SELECT 
							COUNT(t_participation.f_player_id) AS players3
						FROM t_participation
						GROUP BY
							t_participation.f_game_id
						HAVING
							players3 = 3) AS player3

		";

		/*$q = "SELECT u.username, a.city, r.region_name, c.name
			FROM users AS u
			INNER JOIN adresses AS a ON a.id = u.adress_id
			LEFT JOIN regions AS r ON r.id = a.region_id
			LEFT JOIN countries AS c ON c.id = a.country_id
			WHERE 1";

			Сколько в holdem_no_limit было сыграно раздач и за какими столами, 
			и группироваться по ББ



		$q = "SELECT username, COUNT(*) FROM users GROUP BY username";

		$q = "SELECT COUNT(DISTINCT username) FROM users";*/

		/*$q = "SELECT c.title AS category_name, p.title AS product_name 
			FROM products_categories AS pc 
			LEFT JOIN categories AS c ON pc.category_id = c.id 
			LEFT JOIN products AS p ON pc.product_id = p.id 
			WHERE 1";*/

		$query = $this->db->query($q);
		$result = $query->result();
var_dump($result);exit;
		return $result;
	}
}