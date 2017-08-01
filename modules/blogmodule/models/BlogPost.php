<?php
class BlogPost extends ObjectModel
{
    public $id_blogmodule;
    public $title;
    public $content;
    public $date;
    public static $definition = array(
        'table' => 'blogmodule',
        'primary' => 'id_blogmodule',
        'fields' => array(
            'title' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'content' => array('type' => self::TYPE_STRING, 'validate' => 'isString'),
            'date' => array('type' => self::TYPE_DATE, 'validate' => 'isString')
        ),
    );
}
