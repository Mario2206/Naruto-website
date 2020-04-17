<?php
namespace Model;
/**
 * 
 */
class Deletedata extends Model {

    public function deleteFromBdd($table, $filters = null) {
        $delete = "DELETE FROM ".$table;

        if($filters != null ) {
            $delete.=" WHERE ";

            foreach($filters as $key=>$filter) {
                $delete.= $key." = :".$key." AND ";
            }
            $delete = rtrim($delete, " AND ");
        }

        echo $delete;
        $req = $this->bdd->prepare($delete);
        $result = $req->execute($filters);
        return $result==1;
        
    }

}