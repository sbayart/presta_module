<?php
class BlogModule extends Module
{
    public function __construct()
    {
        $this->name = 'blogmodule';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Solene ANTOINE';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('My blog module');
        $this->description = $this->l('Description of my blog module.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('BLOGMODULE_NAME')) {
            $this->warning = $this->l('No name provided');
        }
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        if (!parent::install() 
            || !$this->registerHook('displayHome') 
            || !$this->installDb() 
            || !$this->installTab()
        ) {
            return false;
        }
        return true;
    }

    public function installDB()
    {
        return Db::getInstance()->execute(
            'CREATE TABLE IF NOT EXISTS '._DB_PREFIX_.'blogmodule (
    	        id_blogmodule INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    	        title VARCHAR(200) NOT NULL,
                content TEXT NOT NULL,
                date DATETIME DEFAULT CURRENT_TIMESTAMP)'
        );
    }

    public function installTab()
    {
        $adminTab = new Tab();
        $adminTab->active = 1;
        $adminTab->class_name = 'AdminBlogModule';
        $adminTab->name = array();
        foreach (Language::getLanguages(true) as $lang) {
            $adminTab->name[$lang['id_lang']] = 'Mon Module de Blog';
        }
        $adminTab->id_parent = 0;
        $adminTab->module = $this->name;
        return $adminTab->add();
    }


    public function hookDisplayHome($params)
    {
        $this->context->smarty->assign(
            array(
                'blog_module_name' => Configuration::get('BLOGMODULE_NAME'),
                'blog_module_link' => $this->context->link->getModuleLink('blogmodule', 'display')
                )
        );
        return $this->display(_PS_MODULE_DIR_.'blogmodule/blogmodule.php', 'blogmodule.tpl');
    }

    public function uninstall()
    {
        if (!parent::uninstall() 
            || !$this->uninstallDB() 
            || !$this->uninstallTab()
        ) {
            return false;
        }
        return true;
    }
    public function uninstallDB()
    {
        return Db::getInstance()->execute('DROP TABLE '._DB_PREFIX_.'blogmodule');
    }

    public function uninstallTab()
    {
        $id_tab = (int)Tab::getIdFromClassName('AdminBlogModule');
        if ($id_tab) {
            $tab = new Tab($id_tab);
            return $tab->delete();
        } else {
            return false;
        }
    }
}
