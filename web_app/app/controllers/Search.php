<?php

namespace app\controllers;

class Search
{
    function index()
    {
        $games_by_date_relise = \app\models\Search::findAll('id, img, title, description, full_coast, ea_play_coast, game_pass_coast',
            ' where title like \'%' . clean_request($_POST['request']) . '%\'');
        echo json_encode($games_by_date_relise);
    }
}