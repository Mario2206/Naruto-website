<?php 

namespace Template;

class Table {

    private $keys;
    private $data = [];
    private $surroundTags = [];

    public function __construct(array $keys, array $data)
    {

        $this->keys = $keys;
        $this->data = $data;
        
    }

    /**
     * To define surroundTag for specific element 
     * 
     * @param array surroundTags ["key_in_array/object"=>"<tag> [::data] </tag>"]
     */
    public function setSurroundTag(array $surroundTags) {

        $this->surroundTags = $surroundTags;

    }

    public function init() {

        $keys = $this->keys;
        $data = $this->encapsulateElement($this->data);

        require(ROOT."/views/components/templates/tempTable.php");
    }

     /**
     * To apply surround tag to specific elements, according to surroundTags property  
     * 
     * @param array $data
     * 
     * !return array $newData
     * 
     */
    private function encapsulateElement(array $dataInit) {

        $arr_data = $dataInit;
        $surround_keys = array_keys($this->surroundTags);

        foreach($arr_data as $k1=>$data) : 

            $dataType = gettype($data);

            foreach($data as $k=>$entry) :

                if(in_array($k, $surround_keys)) {

                    if($dataType === "object") {

                        $arr_data[$k1]->$k = str_replace("[::data]",$data->$k,$this->surroundTags[$k]);

                    } else if ($dataType === "array") {
                     
                        $arr_data[$k1][$k] = str_replace("[::data]",htmlspecialchars($data[$k]),$this->surroundTags[$k]);

                    }  
                } 
                // else {

                //     if($dataType === "object") {

                //         $arr_data[$k1]->$k = htmlspecialchars($data->$k);

                //     } else if ($dataType === "array") {
                     
                //         $arr_data[$k1][$k] = htmlspecialchars($data[$k]);

                //     }

                // }


            endforeach;

        endforeach;

        return $arr_data ?? $dataInit;
    }
}