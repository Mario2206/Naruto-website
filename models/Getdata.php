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

            $filterKeys = array_combine(array_keys($filters), array_keys($filters));

            $query .= " WHERE ".$this->arrayToString($filterKeys, ["", " = :"," AND "]);

        }

        $req = $this->bdd->prepare($query);
        $req->execute($filters ?? []);

        return (int) get_object_vars($req->fetch())["COUNT(*)"];
    }

    /**
     * To get entries from join tables
     * 
     * @param array tables (first item  is the main table)
     * @param array entries ["table_name.field"=>"alias"]
     * @param array joints ["table_name.field"=> "table_name.field"]
     * @param array $filters ["field"=>"value"]
     * @param array limits ["start", "limit"]
     * 
     * !return array $data
     */
    public function getFromTables(array $tables, array $entries, array $joints, array $filters = [], array $limits = []) : array {

        $filterKeys = array_combine(array_keys($filters), array_keys($filters));
        $query = "SELECT ";
        
        $query.= $this->arrayToString($entries, [""," AS ",", "])
                ." FROM ".$tables[0]
                ." INNER JOIN ".$tables[1]
                ." ON ".$this->arrayToString($joints, ["", " = ", ""]);

        if($filters) {
            $query .= " WHERE ".$this->arrayToString($filterKeys, ["", " = :"," AND "]);
        }
            
        $query .= " ORDER BY ".$tables[0].".id DESC";

        
        if($limits) {
            $query .=" LIMIT {$limits[0]}, {$limits[1]}";
        }


        $req = $this->bdd->prepare($query);
        $req->execute($filters);

        return $req->fetchAll();
        
    }

    /**
     * convert associative array to string
     * 
     * @param array $data_to_convert
     * @param array $separators ["before","between", "after]
     * 
     * !return string
     */
    private function arrayToString(array $data, array $separators) : string {

        $r = "";

        foreach($data as $k=> $d) {
            $r .= $separators[0].$k.$separators[1].$d.$separators[2];
        }

        
        return rtrim($r, $separators[2]);

    }
    
}