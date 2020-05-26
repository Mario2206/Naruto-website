<?php
namespace Model;
/**
 * 
 */
class Getdata extends Model {
   /**
    * To get all entries af a table
    *@param string table name
    *!return array $data
    */
    public function getAll(string $table) : array{
        $req = $this->bdd->query("SELECT * FROM ".$table." ORDER BY id DESC");
        return $req->fetchAll();
    }

    /**
     * To get entries according to some filters
     * 
     * @param string table name
     * @param array filters
     * @param array limits
     * 
     * !return array $data
     */
    public function getByFilters(string $table, array $filters, array $limits = []) : array {
        $query = "SELECT * FROM ".$table." WHERE ";

        foreach($filters as $key=>$filter) {
            $query.= $key."= :".$key." AND ";
        }
        $query = rtrim($query, " AND ");
        $query.= " ORDER BY id DESC";

        if($limits && count($limits) === 2) {
            // $query .= " LIMIT :start , :limit";
            $query .= " LIMIT {$limits[0]}, {$limits[1]}";
            //$filters = array_merge($filters, ["start"=>$limits[0], "limit"=>$limits[1]]);
        }
    
        $req = $this->bdd->prepare($query);
        $req->execute($filters);
        return $data = $req->fetchAll(); 

    }

    /**
     * To get the id of the only one entry
     * 
     * @param string table name
     * @param array filter
     * 
     * !return string id
     */
    public function getId(string $table, array $filter) : string {
        $data = $this->getByFilters($table, $filter);
        return $data[0]->id ?? false;
    }

    /**
     * To get the all entries' id of  in a table
     * 
     * @param string table name
     * 
     * !return array $data
     */
    public function getAllIds(string $table) : array {
        $req = $this->bdd->query("SELECT id FROM ".$table." ORDER BY sending_date DESC");
        return $req->fetchAll();
    }

    /**
     * To count entries according to filters or not
     * 
     * @param string table name
     * @param array filters
     * 
     * !return string data
     */
    public function getNumberOfEntries(string $table, array $filters = null) : int {

        $query = "SELECT COUNT(*) FROM ".$table;

        if($filters) {
            $query .= " WHERE ";

            foreach($filters as $k=>$v) {
                $query .= "{$k}= :{$k} AND ";
            }

            $query = rtrim($query, " AND ");
        }

        $req = $this->bdd->prepare($query);
        $req->execute($filters ?? []);

        return (int) get_object_vars($req->fetch())["COUNT(*)"];
    }
    
}