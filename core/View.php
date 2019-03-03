<?php

class View{
    protected $_head, $_body, $_siteTitle = SITE_TITLE, $_outputBuffer, $_layout = DEFAULT_LAYOUT;

    public function __construct()
    {
        # code...
    }

    public function render($viewName){
        $viewArray = explode('/',$viewName);
        $viewString = implode(DS,$viewArray);

        if(file_exists(ROOT.DS.'app'.DS.'views'.DS.$viewString.'.php')){
            include(ROOT.DS.'app'.DS.'views'.DS.$viewString.'.php');
            include(ROOT.DS.'app'.DS.'views'.DS.'layouts'.DS.$this->_layout.'.php');
        }
    }

    //most of these functions are getters

    public function content($type){
        if ($type=='head'){
            return $this->_head;
        }elseif ($type=='body'){
            return $this->_body;
        }
        return false;        
    }

    public function start($type)
    {
        $this->_outputBuffer = $type;
        ob_start();
    }

    public function end(){

        if ($this->_outputBuffer == 'head'){
            $this->_head = ob_get_clean();
        }elseif ($this->_outputBuffer == 'body'){
            $this->_body = ob_get_clean();
        }else{
            debugPrint('First run start method!!!');
        }

    }

    public function siteTitle()
    {
        return $this->_siteTitle;
    }
    public function setSiteTitle($title){
        $this->_siteTitle = $title;
    }

    public function setLayout($path){
        $this->_layout = $path;
    }
}
