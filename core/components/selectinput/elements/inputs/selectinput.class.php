<?php

class SelectInput extends cbBaseInput {
    public $defaultIcon = 'chunk_A';
    public $defaultTpl = '[[+value]]';

    
    /**
     * @return array
     */
    public function getJavaScripts() {
        $assetsUrl = $this->modx->getOption('selectinput.assets_url', null, MODX_ASSETS_URL . 'components/selectinput/');
        return array(
            $assetsUrl . 'js/inputs/select.input.js',
        );
    }

    /**
     * @return array
     */
    public function getTemplates()
    {
        $tpls = array();
        
        // Grab the template from a .tpl file
        $corePath = $this->modx->getOption('selectinput.core_path', null, MODX_CORE_PATH . 'components/selectinput/');

        $template = file_get_contents($corePath . 'templates/selectinput.tpl');
        
        // Wrap the template, giving the input a reference of "selectinput", and
        // add it to the returned array.
        $tpls[] = $this->contentBlocks->wrapInputTpl('selectinput', $template);
        return $tpls;
    }

    public function getName()
    {
        return 'Select Input'; 
        // return $this->modx->lexicon('selectinput.input_name');
    }
    
    public function getDescription()
    {
        return 'Select box (available placeholders: [[+value]], [[+display]]'; 
        // return $this->modx->lexicon('selectinput.input_description');
    }

    public function getFieldProperties()
    {
        return array(
            array(
                'key' => 'class_options',
                'fieldLabel' => 'List of display names and values',
                'xtype' => 'textarea',
                'default' => '',
                'description' => 'Define available values as \"Displayed Value=placeholder_value\", one per line. If you only pass a single value per line (such as \"foo\"), that will be used as both displayed and placeholder value.'
            ),
            array(
                'key' => 'default_class',
                'fieldLabel' => 'Default Value',
                'xtype' => 'textfield',
                'default' => '',
                'description' => 'Default value to use, leave blank if none'
            ),
        );
    }
}