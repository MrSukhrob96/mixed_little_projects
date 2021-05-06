<?php

namespace application\models;

use application\core\Model;

class InsertAtc extends Model
{
    public $arr = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function getLikeHuman($fioData)
    {
        $this->db->row("SELECT DISTINCT fio FROM newwanted_ WHERE fio LIKE'%$fio%' ORDER BY fio");
	}
}
