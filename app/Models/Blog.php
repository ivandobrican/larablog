<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['title','body','featured_image','slug','meta_title','meta_description','status'];

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
