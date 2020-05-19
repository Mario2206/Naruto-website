<?php
namespace Model;
/**
 * 
 */
class Getdata extends Model {
   
    public function getAll($table) {
        $req = $this->bdd->query("SELECT * FROM ".$table." ORDER BY id DESC");
        return $req->fetchAll();
    }
    public function getByFilters($table,$filters) {//$filter is an object
        $query = "SELECT * FROM ".$table." WHERE ";

        foreach($filters as $key=>$filter) {
            $query.= $key."= :".$key." AND ";
        }
        $query = rtrim($query, " AND ");
        $req = $this->bdd->prepare($query);
        $req->execute($filters);
        return $data = $req->fetchAll(); 

    }

    public function getId($table,$filter) {
        $data = $this->getByFilters($table, $filter);
        return $data[0]->id;
    }
    public function getAllIds($table) {
        $req = $this->bdd->query("SELECT id FROM ".$table." ORDER BY sending_date DESC");
        return $req->fetchAll();
    }
    
}