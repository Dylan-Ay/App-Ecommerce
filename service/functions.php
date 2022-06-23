<?php
    include_once('db/DAO.php');
    $db = new DAO;

// Function to get the product which has been visited
function get_seen_product($id)
    {
        global $db;
        $request = "SELECT * FROM products WHERE product_id = ?";
        $state = $db->getDb()->prepare($request);
        $state->execute([$id]);
        return $productSeen = $state->fetch();
    }