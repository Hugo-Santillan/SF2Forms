<?php

namespace Service\Extensions;

class SF2FormsExtension extends \Twig_Extension
{

    private $ServiceContainer;
    private $FormConfig = array("nodiv" => "","fieldCSS" => "","divCSS" => "" );

    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('nodiv', array($this, 'nodiv')),
            new \Twig_SimpleFunction('fieldCSS', array($this, 'fieldCSS')),
            new \Twig_SimpleFunction('divCSS', array($this, 'divCSS')),

            new \Twig_SimpleFunction('formstart', array($this, 'formstart'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('formend', array($this, 'formend'),array('is_safe' => array('html'))),

            new \Twig_SimpleFunction('text', array($this, 'text'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('hidden', array($this, 'hidden'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('password', array($this, 'password'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('radio', array($this, 'radio'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('checkbox', array($this, 'checkbox'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('email', array($this, 'email'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('select', array($this, 'select'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('textarea', array($this, 'textarea'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('toogle', array($this, 'toogle'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('datepicker', array($this, 'datepicker'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('timepicker', array($this, 'timepicker'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('fileupload', array($this, 'fileupload'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('button', array($this, 'button'),array('is_safe' => array('html'))),

            new \Twig_SimpleFunction('array2Table', array($this, 'array2Table'),array('is_safe' => array('html'))),
            new \Twig_SimpleFunction('SingleArray2Table', array($this, 'SingleArray2Table'),array('is_safe' => array('html'))),

        );
    }

    public function getName()
    {
        return 'SF2FormsExtension';
    }

    public function setService($service){
        $this->ServiceContainer = $service;
    }

    private function FieldProcess(array $values){
        if($this->FormConfig["nodiv"]){ $values["nodiv"] = "true";}
        if($this->FormConfig["fieldCSS"] != ""){
            if(array_key_exists("class",$values)){
                $values["class"].= " ".$this->FormConfig["fieldCSS"];
            }else{
                $values["class"] = $this->FormConfig["fieldCSS"];
            }
        }

        if($this->FormConfig["divCSS"] != ""){
            if(array_key_exists("divclass",$values)){
                $values["divclass"].= " ".$this->FormConfig["divCSS"];
            }else{
                $values["divclass"] = $this->FormConfig["divCSS"];
            }
        }
        return $values;
    }

    public function formstart($values = array()){
        return $this->ServiceContainer->get('templating')->render('::Fields/formstart.html.twig', $values);
    }

    public function formend(){
        return $this->ServiceContainer->get('templating')->render('::Fields/formend.html.twig');
    }

    public function nodiv($switch){
        $this->FormConfig["nodiv"] = $switch;
    }

    public function fieldCSS($string = ""){
        $this->FormConfig["fieldCSS"] = $string;
    }

    public function divCSS($string = ""){
        $this->FormConfig["divCSS"] = $string;
    }

    public function text(array $values){
        return $this->ServiceContainer->get('templating')->render('::Fields/text.html.twig', $this->FieldProcess($values));
    }

    public function hidden(array $values){
        return $this->ServiceContainer->get('templating')->render('::Fields/hidden.html.twig', $this->FieldProcess($values));
    }

    public function password(array $values){
        return $this->ServiceContainer->get('templating')->render('::Fields/password.html.twig', $this->FieldProcess($values));
    }

    public function radio(array $values){
        return $this->ServiceContainer->get('templating')->render('::Fields/radio.html.twig', $this->FieldProcess($values));
    }

    public function checkbox(array $values){
        return $this->ServiceContainer->get('templating')->render('::Fields/checkbox.html.twig', $this->FieldProcess($values));
    }

    public function email(array $values){
        return $this->ServiceContainer->get('templating')->render('::Fields/email.html.twig', $this->FieldProcess($values));
    }

    public function select(array $values){
        return $this->ServiceContainer->get('templating')->render('::Fields/selectbox.html.twig', $this->FieldProcess($values));
    }

    public function textarea(array $values){
        return $this->ServiceContainer->get('templating')->render('::Fields/textarea.html.twig', $this->FieldProcess($values));
    }

    public function toogle(array $values){
        return $this->ServiceContainer->get('templating')->render('::Fields/switch.html.twig', $this->FieldProcess($values));
    }

    public function datepicker(array $values){
        return $this->ServiceContainer->get('templating')->render('::Fields/datepicker.html.twig', $this->FieldProcess($values));
    }

    public function timepicker(array $values){
        return $this->ServiceContainer->get('templating')->render('::Fields/timepicker.html.twig', $this->FieldProcess($values));
    }

    public function fileupload(array $values){
        return $this->ServiceContainer->get('templating')->render('::Fields/fileupload.html.twig', $this->FieldProcess($values));
    }

    public function button(array $values = array()){
        return $this->ServiceContainer->get('templating')->render('::Fields/button.html.twig', $this->FieldProcess($values));
    }

}