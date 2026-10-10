<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['username', 'full_name', 'email','password', 'avatar', 'created_at'];
    protected $useTimestamps = false; 

    
}