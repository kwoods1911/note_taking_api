<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    protected $table = 'notes';
    protected $connection = 'mysql';
    protected $fillable = ['note_title', 'note_body'];
    use HasFactory;
}
