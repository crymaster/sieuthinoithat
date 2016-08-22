<?php
    /**
     * Product model
     */
class ProductModel {
    private $db;
    
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this -> db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
	
	public function getBestSaleProduct(){
		$sql = 'SELECT		P. proID
							,P.proName
							,P.images
							,C.cateID
							,GC.gpCateID
				FROM 		orderdetail O
				INNER JOIN 	product P 
					ON 		O.proID = P.proID
				INNER JOIN 	product_category PC 
					ON 		P.proID = PC.proID
				INNER JOIN 	category C 
					ON 		PC.cateID = C.cateID
				INNER JOIN 	group_category GC 
					ON 		C.gpCateID = GC.gpCateID
				WHERE		O.status = 3
				GROUP BY	P.proID
				ORDER BY	sum( O.quantity ) DESC
				LIMIT 0 ,5';
		$query = $this->db->prepare($sql);
		$query -> execute();
		return $query -> fetchAll();
	}
	
	public function updateProductViewNumber($customer_id, $product_id) {
		// Check if this customer already view this product
		$sql_select =
		'SELECT COUNT(1)
		FROM 	customer_view_history
		WHERE	cId = :cId
		AND		proId = :proId';
		$param_array = array(':cId' => $customer_id, 
							':proId'=> $product_id);
		$query_select = $this->db->prepare($sql_select);
		$query_select->execute($param_array);
		$count = $query_select->fetchColumn();
		
		// If not view yet, insert a record
		if ($count == 0) {
		
			$sql_insert = 
			'INSERT INTO customer_view_history
			(cId,
			proId,
			lastViewDate,
			viewNumber)
			VALUES
			(:cId,
			:proId,
			NOW(),
			:viewNumber)';
			$param_array = array(':cId' 		=> $customer_id, 
								':proId'		=> $product_id,
								':viewNumber'	=> 1);
			$query_insert = $this->db->prepare($sql_insert);
			$query_insert->execute($param_array);
			return;
		}
		
		// If already view, update +1
		$sql_update =
		'UPDATE customer_view_history
		SET 	viewNumber = viewNumber + 1
				,lastViewDate = NOW()
		WHERE	cId = :cId
		AND		proId = :proId';
		$param_array = array(':cId' 		=> $customer_id, 
							':proId'		=> $product_id);
		$query_update = $this->db->prepare($sql_update);
		$query_update->execute($param_array);
	}

	public function getRelatedProduct($proId_array) {
		$in_list = implode(",", $proId_array);
		$sql = 
		"SELECT	P. proID
				,P.proName
				,P.images
				,C.cateID
				,GC.gpCateID
		FROM
			(SELECT	 P. proID
					,P.proName
					,P.images
					,PR.total_point
			FROM		product	 P
			INNER JOIN	product_relation PR
				ON	PR.proId2 = P.proID
				AND PR.proId1 IN ($in_list)
			UNION
			SELECT 	P. proID
					,P.proName
					,P.images
					,PR.total_point
			FROM		product	 P
			INNER JOIN	product_relation PR
				ON	PR.proId1 = P.proID
				AND PR.proId2 IN ($in_list)
			) P
		INNER JOIN 	product_category PC 
			ON 		P.proID = PC.proID
		INNER JOIN 	category C 
			ON 		PC.cateID = C.cateID
		INNER JOIN 	group_category GC 
			ON 		C.gpCateID = GC.gpCateID
		ORDER BY	P.total_point DESC
		LIMIT		0, 10";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
	
	public function getRecentViewProduct($customer_id) {
		$sql = 
		"SELECT 	P. proID
					,P.proName
					,P.images
					,C.cateID
					,GC.gpCateID
		FROM		customer_view_history VH
		INNER JOIN	product	P
			ON		P.proID = VH.proId
		INNER JOIN 	product_category PC 
			ON 		P.proID = PC.proID
		INNER JOIN 	category C 
			ON 		PC.cateID = C.cateID
		INNER JOIN 	group_category GC 
			ON 		C.gpCateID = GC.gpCateID
		WHERE		VH.cId = 6
		ORDER BY	VH.lastViewDate DESC
		LIMIT		0, 10;";
		$query = $this->db->prepare($sql);
		$query->execute();
		return $query->fetchAll();
	}
}
?>