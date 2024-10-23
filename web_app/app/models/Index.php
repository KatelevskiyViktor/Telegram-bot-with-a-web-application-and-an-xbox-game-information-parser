<?php

namespace app\models;

use xx\Model;

class Index extends Model
{
    const TABLE = 'games';

    public $id;
    public $title;
    public $description;
    public $rating;
    public $full_coast;
    public $ea_play_coast;
    public $game_pass_coast;
    public $time_sale;
    public $img;
    public $ganre;
    public $relise_date;
    public $last_update;

}