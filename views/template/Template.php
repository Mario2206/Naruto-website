<?php
namespace Template;

class Template {

    /**
     * class to create a functional template
     * 
     * @param $content -> HTML content (inside the body)
     * @param $css -> path(s) to find css file(s)
     * @param $js -> path(s) to find js file(s)
     * 
     * !return HTML page 
     */

    
     private $links;
     private $scripts;
     private $content;

     private $data = []; 

    public function __construct(string $content, array $css = [], array $js = []) {
        $this->content = $content;  
        
        foreach($css as $css) {
            $this->links.=$this->createLink($css);
        }

        foreach($js as $js) {
            $this->scripts.= $this->createScript($js);
        }
        
    }


    public function init() {
        $data = $this->data;
        $links = $this->links;
        $content = $this->content;
        $scripts = $this->scripts;

        require("../views/components/temp1.php");
    }

    private function createLink(string $css) : string {
        return "<link rel=\"stylesheet\" href=\"{$css}\">";
    }
    private function createScript(string $js) : string {
        return "<script src=\"{$js}\"></script>";
    }
}