<?php
namespace App\Model;

use FlyPhp\Model\Base;

class User extends Base
{
    protected $dbType = 'mongodb';
    protected $collection = 'user';
}
