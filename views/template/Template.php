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
     private $jsLibs;
     private $content;

     private $data = []; 
     private $view;

    public function __construct(string $content, array $css = [], array $js = []) {
        $this->defineHtmlTemplate("temp1.php");
        $this->content = $content;  
        
        foreach($css as $css) {
            $this->links.=$this->createLink($css);
        }

        foreach($js as $js) {
            $this->scripts.= $this->createScript(PATH."js/".$js);
        }
        
    }

    /**
     * Init the view on the page : 
     * 
     * @param array $var to contextualise
     * 
     * !return string HTML page 
     */

    public function init(array $varForContext = null) {
        $title = $this->title;
        $links = $this->links;
        $content = $this->content;
        $scripts = $this->scripts;
        $jsLibs = $this->jsLibs;
        $varForContext ? extract($varForContext) : false;

        require($this->view);
    }

    /**
     * For changing the html template
     * 
     * @param string $temp_path -> path of the template
     */
    public function defineHtmlTemplate($temp_path) {
        $this->view = ROOT."/views/components/templates/".$temp_path;
    }

    public function addExternalScript(array $jsLibs) {
        foreach($jsLibs as $lib) {
            $this->jsLibs .= $this->createScript($lib);
        }
        
    }
    /**
     * method to create link tag
     * @param string $css
     * 
     * !return string css tag
     */

    private function createLink(string $css) : string {
        return "<link rel=\"stylesheet\" href=\"".PATH."style/".$css."\">";
    }
    /**
     * method to create script tag
     * @param string $css
     * 
     * !return string script tag
     */
    private function createScript(string $path) : string {
        
        return "<script src=\"".$path."\"></script>";
    }

}