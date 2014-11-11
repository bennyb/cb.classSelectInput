<?php

class ClassSelectInput extends cbBaseInput {
    public $defaultIcon = 'chunk_A';
    public $defaultTpl = '[[+value]]';

    
    /**
     * @return array
     */
    public function getJavaScripts() {
        $assetsUrl = $this->modx->getOption('classselectinput.assets_url', null, MODX_ASSETS_URL . 'components/classselectinput/');
        return array(
            $assetsUrl . 'js/inputs/classselect.input.js',
        );
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        $tpls = array();
        
        // Grab the template from a .tpl file
        $corePath = $this->modx->getOption('classselectinput.core_path', null, MODX_CORE_PATH . 'components/classselectinput/');

        $template = file_get_contents($corePath . 'templates/classselectinput.tpl');
        
        // Wrap the template, giving the input a reference of "classselectinput", and
        // add it to the returned array.
        $tpls[] = $this->contentBlocks->wrapInputTpl('classselectinput', $template);
        return $tpls;
    }

    public function getName()
    {
        return 'Class Select Input'; 
        // return $this->modx->lexicon('classselectinput.input_name');
    }
    
    public function getDescription()
    {
        return 'Select box for classes'; 
        // return $this->modx->lexicon('classselectinput.input_description');
    }

    public function getFieldProperties()
    {
        return array(
            array(
                'key' => 'class_options',
                'fieldLabel' => 'List of classes and values',
                'xtype' => 'textfield',
                'default' => '',
                'description' => 'classname=Class Name,classname2=Class Name2'
            ),
            array(
                'key' => 'default_class',
                'fieldLabel' => 'Default Class',
                'xtype' => 'textfield',
                'default' => '',
                'description' => 'Default clasee to use, leave blank if none'
            ),
        );
    }
}