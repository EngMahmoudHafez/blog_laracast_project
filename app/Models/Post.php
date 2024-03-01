<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    protected $fillable=['category_id','title','body','slug','excerpt'];
        // this is the same as eager loading with load() function
    protected $with =['category','author'];
    function getRouteKeyName()
    {
        return 'slug'; // TODO: Change the autogenerated stub
    }
    public function category(){
       return  $this->belongsTo(Category::class);
    }
    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }
}
