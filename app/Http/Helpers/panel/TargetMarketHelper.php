<?php
namespace App\Http\Helpers\panel;

use App\Models\TargetMarket;
use Cviebrock\EloquentSluggable\Services\SlugService;

class TargetMarketHelper{

    public function getCustomerGroup()
    {

        return TargetMarket::orderByDesc('id')->get();
    }
    public function getActiveCustomerGroup()
    {

        return TargetMarket::where('status','=',1)->orderByDesc('id')->get();
    }
    public function deleteAll($ids)
    {
        return TargetMarket::whereIn('id', explode(',', $ids))->delete();
    }

    public function store($data)
    {
        if(isset($data['slug']) && !empty($data['slug']))
        $slug = SlugService::createSlug(TargetMarket::class, 'slug', $data['slug']);
        else
        $slug = SlugService::createSlug(TargetMarket::class, 'slug', $data['name']);

        $data['slug'] = $slug;

        $cgrp = new TargetMarket();
        $cgrp->name = $data['name'];
        $cgrp->slug = $data['slug'];
        $cgrp->description = isset($data['description'])?$data['description']:null;
        $cgrp->approve_customer  = isset($data['approve_customer'])?$data['approve_customer']:0;
        $cgrp->status = 1;
        $cgrp->save();
    }

    public function update($cgrp ,$data)
    {
        if(isset($data['slug']) && !empty($data['slug']))
        $slug =  $data['slug'];
        else
        $slug = SlugService::createSlug(TargetMarket::class, 'slug', $data['name']);

        $data['slug'] = $slug;
        $data['description'] = isset($data['description'])?$data['description']:null;
        $data['approve_customer'] = isset($data['approve_customer'])?$data['approve_customer']:0;
        $cgrp->update($data);
    }
}
