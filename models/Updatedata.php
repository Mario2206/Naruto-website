<?php

namespace Model;
/**
 * 
 */
class Updatedata extends Model {

    public function updateBdd(string $table, array $changes, array $filters = null) : bool {
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