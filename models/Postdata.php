<?php
namespace Model;
/**
 * 
 */
class Postdata extends Model {

    public function setData(string $table, array $postInfos) : bool {
        $postInit = "INSERT INTO ".$table;
        $postIndexes = '(';
        $postItemsVar = '(';

        foreach($postInfos as $key=>$info) {
            $postItemsVar.= ':'.$key.',';
            $postIndexes .= '`'.$key.'`,';
        }
        $postIndexes = rtrim($postIndexes, ',');
        $postItemsVar = rtrim($postItemsVar, ',');
        $postIndexes.= ') ';
        $postItemsVar.= ')';

        $post = $postInit.$postIndexes."VALUES".$postItemsVar;

        $req = $this->bdd->prepare($post);
        
        $result = $req->execute($postInfos);
        return $result == 1;

    }
}