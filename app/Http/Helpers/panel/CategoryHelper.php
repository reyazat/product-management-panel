<?php
namespace App\Http\Helpers\panel;

use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryHelper{

    public function getAll()
    {

        return Category::with('parent')->orderByDesc('id')->get();
    }

    public function getParents()
    {

        return Category::whereNull('parent_id')->where('status','=',1)->orderByDesc('id')->pluck('name','id')->toArray();
    }

    public function getActive()
    {
        return Category::with('children')->whereNull('parent_id')->where('status','=',1)->orderByDesc('id')->get();
    }
    public function deleteAll($ids)
    {
        return Category::whereIn('id', explode(',', $ids))->delete();
    }

    public function store($data)
    {
        if(isset($data['slug']) && !empty($data['slug']))
        $slug = SlugService::createSlug(Category::class, 'slug', $data['slug']);
        else
        $slug = SlugService::createSlug(Category::class, 'slug', $data['name']);


        $data['slug'] = $slug;
        $cgrp = new Category();
        $cgrp->name = $data['name'];
        $cgrp->parent_id = $data['Parent'];
        $cgrp->description = $data['description'];
        $cgrp->meta_title = $data['meta_title'];
        $cgrp->meta_description = $data['meta_description'];
        $cgrp->image = isset($data['image'])?$data['image']:null;
        $cgrp->status = 1;
        $cgrp->save();
    }

    public function update($cgrp ,$data)
    {
        if(isset($data['slug']) && !empty($data['slug']))
        $slug = $data['slug'];
        else
        $slug = SlugService::createSlug(Category::class, 'slug', $data['name']);

        $data['slug'] = $slug;
        $data['parent_id'] = isset($data['Parent'])?$data['Parent']:null;
        $data['image'] = isset($data['image'])?$data['image']:null;
        $cgrp->update($data);
    }
}
