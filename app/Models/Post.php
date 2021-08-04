<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Post extends Model
{
    use HasFactory;
    // change it if you change the directory if images(or maybe moved to another disk)
    protected $guarded = ['post_id' , 'id' , 'created_at' , 'updated_at'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public static function monthly_posts()
    {
        $output = [];
        $current_month = now()->month - 1;
        for($i = 0 ; $i < 12 ; $i++){
            $output[$current_month --] = Post::where('created_at','>=',now()->startOfMonth()->subMonths($i)->toDateTimeString())->where('created_at','<',now()->startOfMonth()->subMonths($i-1)->toDateTimeString())->count();
            if($current_month == -1)$current_month = 11;
        }
        ksort($output);
        return $output;
    }
}
