<?php
namespace App\Http\Helpers\panel;

use App\Models\Option;

class OptionHelper{

    public function getAll()
    {

        return Option::with('optionValues')->orderByDesc('sorted')->get();
    }


    public function deleteAll($ids)
    {
        return Option::whereIn('id', explode(',', $ids))->delete();
    }

    public function store($data)
    {

        $opt = new Option();
        $opt->name = $data['name'];
        $opt->type = $data['type'];
        $opt->sorted = $data['sorted'];
        $opt->save();
        $opt->optionValues()->createMany($data['optionvalues']);

    }

    public function update($opt ,$data)
    {

        $opt->update($data);
        $opt->optionValues()->delete();
        $opt->optionValues()->createMany($data['optionvalues']);

    }
}
