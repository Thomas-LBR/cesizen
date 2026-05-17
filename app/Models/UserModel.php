<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'firstname',
        'lastname',
        'email',
        'password_hash',
        'role',
        'is_active',
        'reset_token',
        'reset_expires_at',
    ];
    protected $useTimestamps = true;
    protected $returnType = 'array';

    protected $validationRules = [
        'firstname' => 'required|min_length[2]|max_length[80]',
        'lastname' => 'required|min_length[2]|max_length[80]',
        'email' => 'required|valid_email|max_length[190]',
    ];
}
