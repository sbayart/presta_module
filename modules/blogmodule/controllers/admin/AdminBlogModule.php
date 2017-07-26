<?php
class AdminBlogModuleController extends ModuleAdminController {
    public function __construct()
    {
        $this->table = 'example_data';
        		$this->className = 'ExampleData';
        		$this->lang = true;
        		$this->deleted = false;
        		$this->colorOnBackground = false;
        		$this->bulk_actions = array('delete' => array('text' => $this->l('Delete selected'), 'confirm' => $this->l('Delete selected items?')));
        		$this->context = Context::getContext();
        		// définition de l'upload, chemin par défaut _PS_IMG_DIR_
        		$this->fieldImageSettings = array('name' => 'image', 'dir' => 'example');
        		parent::__construct();
    }
}
 ?>
