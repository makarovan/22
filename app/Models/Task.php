<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $table = 'tasks';
    public $timestamps = true;
    protected $fillable=[
    	'title',
    	'description',
    	'image',
    	'category_id',
    	'created_at'
    ];

    public function category(){
    	return $this->belongsTo('App\Models\Category', 'category_id');
    }
}
