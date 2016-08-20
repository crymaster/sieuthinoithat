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
		$sql = "SELECT 
					P. proID
					,P.proName
					,P.images
					,C.cateID
					,GC.gpCateID
				FROM orderdetail O
				INNER JOIN product P 
					ON O.proID = P.proID
				INNER JOIN product_category PC 
					ON P.proID = PC.proID
				INNER JOIN category C 
					ON PC.cateID = C.cateID
				INNER JOIN group_category GC 
					ON C.gpCateID = GC.gpCateID
				WHERE
					O.status = 3
				GROUP BY 
					P.proID
				ORDER BY 
					sum( O.quantity ) DESC
				LIMIT 0 ,5";
		$query = $this->db->prepare($sql);
		$query -> execute();
		return $query -> fetchAll();
	}

}
?>