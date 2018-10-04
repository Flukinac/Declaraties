<?php
/**
 * Created by PhpStorm.
 * User: Steve
 * Date: 3-10-2018
 * Time: 16:21
 */

class Post extends AppModel
{
    public $validate = array(
        'title' => array(
            'rule' => 'notBlank'
        ),
        'body' => array(
            'rule' => 'notBlank'
        )
    );
}