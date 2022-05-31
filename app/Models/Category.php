<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    public $timestamps = true;

    protected $fillable= [
    	'name',
    	'created_at'
    ];

    public function task(){
    	return $this->hasMany('App/Models/Task');
    }
    public function tasks(){
        return $this->hasMany(Task::class, 'category_id');
       
    }
}
