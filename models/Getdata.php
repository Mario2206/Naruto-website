<?php
namespace Model;
/**
 * 
 */
class Getdata extends Model {
   

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
    
}