<?php

namespace App\Repositories;

use App\Models\Unit;
use App\Repositories\Interface\UnitInterface;
use Illuminate\Support\Str;

class UnitRepositories implements UnitInterface
{
    public function all()
    {
        return Unit::orderBy('id', 'desc')->paginate(10);
    }
    public function store(array $data)
    {
        $name['en'] = $data['name'];
        $unit = new Unit();
        $unit->name = json_encode($name);
        $unit->slug = Str::slug($data['name']);
        $unit->status = $data['status'];
        $unit->save();
    }
    public function update(array $data, $id)
    {
        $unit = Unit::find($id);
        $newName['en'] = json_decode($unit->name)->en;
        foreach ($data['language'] as $key => $language) {
            if ($data['name'][$key]) {
                $newName[$language] = $data['name'][$key];
            }
        }
        $unit->name = json_encode($newName);
        $unit->slug = Str::slug($newName['en']);
        $unit->status = $data['status'];
        $unit->save();
    }
    public function delete($id)
    {
        Unit::find($id)->delete();
    }
    public function statusChange($id)
    {
        $unit = Unit::find($id);
        if($unit->status == 1){
            $unit->status = 0;
        }else{
            $unit->status = 1;
        }
        $unit->save();
    }
    public function restore($id)
    {
        Unit::withTrashed()->find($id)->restore();
    }
    public function onlyTrashed()
    {
        return Unit::onlyTrashed()->get();
    }
    public function forceDelete($id)
    {
        $value = Unit::withTrashed()->find($id);
        if ($value) {
            $value->forceDelete();
        }
    }
}
