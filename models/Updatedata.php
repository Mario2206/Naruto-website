<?php

namespace Model;

class Updatedata extends Model {

    public function updateBdd($table, $changes, $filters = null) {//Chnage is an associative array and filters can be too
        $update = 'UPDATE '.$table.' SET ';
        $changesPart = "";
        $arrayForReq = array();

        foreach($changes as $key=>$change) {
            $changesPart.='`'.$key.'`'.' = :'.$key.', ';
        }
        $changesPart = rtrim($changesPart, ', ');


        $updateReq = $update.$changesPart;

        if($filters != null) {
            $filtersPart = "";

            foreach($filters as $key=>$filter) {
                $filtersPart.= $key.' = :'.$key.', ';
            }

            $filtersPart = rtrim($filtersPart,', ');
            $updateReq.= ' WHERE '.$filtersPart;

        }
        $filters === null ? $arrayForReq = $changes : $arrayForReq = array_merge($changes, $filters);

        $req = $this->bdd->prepare($updateReq);
        $result = $req->execute($arrayForReq);
        return $result == 1;
    }   
}