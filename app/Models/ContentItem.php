<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class ContentItem extends Model {
 protected $fillable=['type','title','slug','status','sort_order','data'];
 protected $casts=['data'=>'array'];
 public function scopeType($q,$type){ return $q->where('type',$type); }
 public function scopePublished($q){ return $q->whereIn('status',['Published','Active','Available','Ongoing','Completed']); }
 public function value(string $key,$default=null){ return data_get($this->data,$key,$default); }
}
