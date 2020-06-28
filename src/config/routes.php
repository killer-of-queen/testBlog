<?php
return array(
    'comment/([0-9]+)' => 'site/comment/$1',
    'message/([0-9]+)' => 'site/open/$1',
    'edit/([0-9]+)' => 'site/edit/$1',
    'im/page-([0-9]+)' => 'site/user/$1',
    'im' => 'site/user',
    'login' => 'user/login',
    'logout' => 'user/logout',
    'create' => 'site/create',
    'page-([0-9]+)' => 'site/index/$1',
    '' => 'site/index',
);