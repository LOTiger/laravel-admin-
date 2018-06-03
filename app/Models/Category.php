<?php

namespace App\Models;

use Encore\Admin\Traits\AdminBuilder;
use Encore\Admin\Traits\ModelTree;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use ModelTree, AdminBuilder;
    protected $fillable=['name','parent_id','order'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setTitleColumn('name');
    }

    public function children()
    {
        return $this->hasMany(Category::class,'parent_id', 'id');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class,'parent_id', 'id');
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

}
