<?php

class Controller {
    
    protected $layout_name = '';//filenme
    protected $template_dir = '';

    protected $layouts_dir = ROOT.'/views/';
    protected $template_main_dir = ROOT.'/views/layouts/';
    protected $content_view = null;
    
    protected function render($content_view, $data = null) {

        include $this->template_main_dir.'header.php';
        include $this->layouts_dir.$content_view.'.php';
        include $this->template_main_dir.'footer.php';
        
    }

    protected function getModel($model_name) {
        include_once(ROOT.'/models/'.$model_name.'.php');
        return new $model_name;
    }
    
}