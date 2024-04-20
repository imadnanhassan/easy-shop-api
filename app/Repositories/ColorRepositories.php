<?php

namespace App\Repositories;

use App\Models\Color;
use App\Repositories\Interface\ColorInterface;

class ColorRepositories implements ColorInterface
{

    public function all()
    {
        return Color::get();
    }

    public function store(array $data): void
    {
        $color = new Color();
        $name['en'] = $data['name'];
        $color->name = json_encode($name);
        $color->code = $data['code'];
        $color->status = $data['status'];
        $color->priority = $data['priority'];
        $color->save();
    }

    public function update(array $data, $id): void
    {
        $color = Color::where('id', $id)->first();
        if ($color) {
            $newName['en'] = json_decode($color->name)->en;
            foreach ($data['language'] as $key => $language) {
                if ($data['name'][$key]) {
                    $newName[$language] = $data['name'][$key];
                }
            }
            $color->name = json_encode($newName);
            
            $color->code = $data['code'];
            $color->status = $data['status'];
            $color->priority = $data['priority'];
            $color->save();
        }
    }

    public function delete($id): void
    {
        Color::where('id', $id)->first()?->delete();
    }
    public function statusChange($id)
    {
        $color = Color::find($id);
        if ($color->status == 1) {
            $color->status = 0;
        } else {
            $color->status = 1;
        }
        $color->save();
    }

    public function restore($id): void
    {
        Color::withTrashed()->where('id', $id)->first()?->restore();
    }

    public function onlyTrashed(): array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
    {
        return Color::onlyTrashed()->get();
    }

    public function forceDelete($id): void
    {
        $value = Color::withTrashed()->find($id);
        if ($value) {
            $value->forceDelete();
        }
    }
}
