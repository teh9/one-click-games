<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'email',
        'password',
        'age'
    ];

    public $data = [
        'name',
        'email',
        'password',
        'age'
    ];
}
