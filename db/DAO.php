<?php 

class DAO{
    
    public function __construct()
    {
        try {
            $this->db = new PDO(
                'mysql:host=localhost;
                dbname=sneakers_website;
                port=3306;
                charset=utf8',
                'root'
            );
            $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } 
            
            catch(Exception $e) {
                echo $e->getMessage();
            }
    }

    public function getDb()
    {
        return $this->db;
    }
}