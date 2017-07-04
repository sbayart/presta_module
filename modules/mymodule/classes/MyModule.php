<?php
class MyModule extends Module
{
    public function __construct()
    {
        $this->name = 'mymodule';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Solene ANTOINE';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Mon tit module');
        $this->description = $this->l('Description de mon tit module.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('MYMODULE_NAME')) {
            $this->warning = $this->l('No name provided');
        }
    }
    public function install()
    {
        if (!parent::install()) {
            return false;
        }
        return true;
    }
    public function uninstall()
    {
        if (!parent::uninstall()
            || !Configuration::deleteByName('MYMODULE_NAME')
        ) {
            return false;
        }

        return true;
    }
}
