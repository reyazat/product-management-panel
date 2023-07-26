<?php
namespace App\Http\Helpers\panel;

use App\Models\Manufacturer;
use Cviebrock\EloquentSluggable\Services\SlugService;

class ManufacturerHelper{

    public function getAll()
    {

        return Manufacturer::orderByDesc('id')->get();
    }
    public function getActive()
    {

        return Manufacturer::where('status','=',1)->orderByDesc('id')->get();
    }
    public function deleteAll($ids)
    {
        return Manufacturer::whereIn('id', explode(',', $ids))->delete();
    }

    public function store($data)
    {
        if(isset($data['slug']) && !empty($data['slug']))
        $slug = SlugService::createSlug(Manufacturer::class, 'slug', $data['slug']);
        else
        $slug = SlugService::createSlug(Manufacturer::class, 'slug', $data['name']);


        $data['slug'] = $slug;

        $cgrp = new Manufacturer();
        $cgrp->name = $data['name'];
        $cgrp->slug = $data['slug'];
        $cgrp->image = isset($data['image'])?$data['image']:null;
        $cgrp->status = 1;
        $cgrp->save();
    }

    public function update($cgrp ,$data)
    {
        if(isset($data['slug']) && !empty($data['slug']))
        $slug =$data['slug'];
        else
        $slug = SlugService::createSlug(Manufacturer::class, 'slug', $data['name']);

        $data['slug'] = $slug;
        $data['image'] = isset($data['image'])?$data['image']:null;
        $cgrp->update($data);
    }
}
