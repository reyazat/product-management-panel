<?php
namespace App\Http\Helpers\panel;

use App\Models\TaxClass;
use Cviebrock\EloquentSluggable\Services\SlugService;

class TaxClassHelper{

    public function getAll()
    {

        return TaxClass::orderByDesc('id')->get();
    }
    public function getActive()
    {

        return TaxClass::where('status','=',1)->orderByDesc('id')->get();
    }
    public function deleteAll($ids)
    {
        return TaxClass::whereIn('id', explode(',', $ids))->delete();
    }

    public function store($data)
    {
        $cgrp = new TaxClass();
        $cgrp->name = $data['name'];
        $cgrp->rate = $data['rate'];
        $cgrp->type = $data['type'];
        $cgrp->status = 1;
        $cgrp->save();
    }

    public function update($cgrp ,$data)
    {
        $cgrp->update($data);
    }
}
