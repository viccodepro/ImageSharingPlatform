<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photos';

    protected $fillable = [
        'title',
        'image'
    ];
    public $timestamps = true;

    // Validation rules for the inputs
    public static $upload_rules = [
        'title'     =>  'required|min:3',
        // 'image'     =>  'file:jpg, jpeg, png, gif'
        'image'     => 'required'
    ];
}
