<?php

namespace app\controllers;

use xx\View;

class Index
{
    public function index()
    {
        $title = 'Магазин игр Xbox';
        $script = '';
        $layout_name = 'main';
        $page_name = 'index';
        $games_by_date_relise = \app\models\Index::findAll('*', ' order by relise_date desc limit 10');
        $course = (float)\app\models\CourseTurLira::findAll('rubles_per_lira', '')[0]->rubles_per_lira;
        View::render($layout_name, $page_name, compact('title', 'script', 'games_by_date_relise', 'course'));
    }
}