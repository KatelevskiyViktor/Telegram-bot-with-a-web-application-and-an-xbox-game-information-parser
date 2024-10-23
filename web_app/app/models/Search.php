<?php

namespace app\models;

use xx\Model;

class Search extends Model
{
    const TABLE = 'games';

    public $id;
    public $title;
    public $description;
    public $img;
    public $full_coast;
    public $ea_play_coast;
    public $game_pass_coast;

}