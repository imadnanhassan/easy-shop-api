<?php

namespace App\Repositories;

use App\Models\BlogTag;
use Illuminate\Support\Str;
use App\Repositories\Interface\BlogTagInterface;

class BlogTagRepositories implements BlogTagInterface
{
    public function all()
    {
        return BlogTag::orderBy('id', 'desc')->paginate(10);
    }
    public function store(array $data)
    {
        $name['en'] = $data['name'];

        $blogTag = new BlogTag();
        $blogTag->name = json_encode($name);
        $blogTag->slug = Str::slug($data['name']);
        $blogTag->status = $data['status'];
        $blogTag->save();
    }
    public function update(array $data, $id)
    {
        $blogTag = BlogTag::find($id);
        $newName['en'] = json_decode($blogTag->name)->en;

        foreach ($data['language'] as $key => $language) {
            if ($data['name'][$key]) {
                $newName[$language] = $data['name'][$key];
            }
        }

        $blogTag->name = json_encode($newName);
        $blogTag->slug = Str::slug($newName['en']);
        $blogTag->status = $data['status'];
        $blogTag->save();
    }
    public function delete($id)
    {
        BlogTag::find($id)->delete();
    }
    public function restore($id)
    {
        BlogTag::withTrashed()->find($id)->restore();
    }
    public function onlyTrashed()
    {
        return BlogTag::onlyTrashed()->get();
    }
    public function forceDelete($id)
    {
        $value = BlogTag::withTrashed()->find($id);
        if ($value) {
            $value->forceDelete();
        }
    }
    public function statusChange($id)
    {
        $unit = BlogTag::find($id);
        if($unit->status == 1){
            $unit->status = 0;
        }else{
            $unit->status = 1;
        }
        $unit->save();
    }
}
