<?php
class AdminBlogModuleController extends ModuleAdminController {
    public function __construct()
    {
        $this->bootstrap = true;
        $this->table = 'blogmodule';
        $this->className = 'BlogPost';

        $this->fields_list = array(
			'title' => array(
				'title' => $this->l('title'),
			),
            'content' => array(
				'title' => $this->l('content'),
			),
            'date' => array(
				'title' => $this->l('date'),
			),
        );

        $this->fields_form = array(
            'legend' => array(
                'title' => $this->l('title'),
            ),
            'input' => array(
                array(
                    'type' => 'text',
                    'label' => $this->l('Titre :'),
                    'name' => 'title'
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Contenu :'),
                    'name' => 'content'
                ),
                array(
                    'type' => 'date',
                    'label' => $this->l('Date du post :'),
                    'name' => 'date'
                )
            ),
            'submit' => array(
                'title' => $this->l('Save'),
				'class' => 'button'
            )
        );
        parent::__construct();
    }
}
