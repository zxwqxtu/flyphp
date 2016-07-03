<?php
namespace App\Model;

use FlyPhp\Model\Base;

class Test extends Base
{
    public function find()
    {
        $data = [];
        $sql = "select * from test where status = 1";
        $stmt = $this->db->query($sql);
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        }

        return $data;
    }
}
