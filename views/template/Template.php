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
     */

     /**
      * title of webpage : Only property that can change
      */
     public $title = "Template";

     private $links;
     private $scripts;
     private $content;

     private $data = []; 
     private $view;

    public function __construct(string $content, array $css = [], array $js = []) {
        $this->view = "../views/components/templates/temp1.php";
        $this->content = $content;  
        
        foreach($css as $css) {
            $this->links.=$this->createLink($css);
        }

        foreach($js as $js) {
            $this->scripts.= $this->createScript($js);
        }
        
    }

    /**
     * Init the view on the page : 
     * !return string HTML page 
     */

    public function init() {
        $title = $this->title;
        $links = $this->links;
        $content = $this->content;
        $scripts = $this->scripts;

        require($this->view);
    }

    /**
     * For changing the html template
     * 
     * @param string $temp_path -> path of the template
     */
    public function defineHtmlTemplate($temp_path) {
        $this->view = $temp_path;
    }
    /**
     * method to create link tag
     * @param string $css
     * 
     * !return string css tag
     */

    private function createLink(string $css) : string {
        return "<link rel=\"stylesheet\" href=\"{$css}\">";
    }
    /**
     * method to create script tag
     * @param string $css
     * 
     * !return string script tag
     */
    private function createScript(string $js) : string {
        return "<script src=\"{$js}\"></script>";
    }
}