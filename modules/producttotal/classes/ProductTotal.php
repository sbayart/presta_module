<?php
class ProductTotal extends Module
{
    public function __construct()
    {
        $this->name = 'producttotal';
        $this->tab = 'front_office_features';
        $this->version = '1.0.0';
        $this->author = 'Solene ANTOINE';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Product Total');
        $this->description = $this->l('Give number of catalogs products.');

        $this->confirmUninstall = $this->l('Are you sure you want to uninstall?');

        if (!Configuration::get('PRODUCTTOTAL_NAME')) {
            $this->warning = $this->l('No name provided');
        }
    }

    public function install()
    {
        if (Shop::isFeatureActive()) {
            Shop::setContext(Shop::CONTEXT_ALL);
        }
        return parent::install() &&
            $this->registerHook('top') &&
            $this->registerHook('header') &&
            Configuration::updateValue('PRODUCTTOTAL_NAME', 'test');
    }

    public function hookDisplayTop()
    {
        $this->context->smarty->assign(
            array(
              'product_total_name' => Configuration::get('PRODUCTTOTAL_NAME'),
              'product_total_link' => $this->context->link->getModuleLink('producttotal', 'display')
            )
        );
        return $this->display(_PS_MODULE_DIR_.'producttotal/producttotal.php', 'producttotal.tpl');
    }

    public function hookDisplayHeader()
    {
        $this->context->controller->addCSS($this->_path.'css/producttotal.css', 'all');
    }

    public static function getProductTotal()
    {
        $productObj = new Product();
        $products = $productObj->getProducts(Context::getContext()->language->id, 0, 0, 'id_product', 'DESC', false, true);
        return count($products);
    }

    public function uninstall()
    {
        if (!parent::uninstall()) {
            return false;
        }
        return true;
    }
}
