<?php

namespace application\models;

use application\core\Model;

class Result extends Model
{
    public $arr = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function getLikeHuman()
    {
        $this->arr = $this->db->row("SELECT DISTINCT fio FROM newwanted_");
		
        return $this->arr;
    }
}
