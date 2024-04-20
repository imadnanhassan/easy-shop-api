<?php

namespace App\Repositories;

use Illuminate\Support\Str;
use App\Models\BlogCategory;
use App\Models\Image;
use App\Repositories\Interface\BlogCategoryInterface;
use App\Traits\Uploadable;

class BlogCategoryRepositories implements BlogCategoryInterface
{
    use Uploadable;
    public function all()
    {
        return BlogCategory::orderBy('id', 'desc')->paginate(10);
    }
    public function store(array $data)
    {
        $name['en'] = $data['name'];
        $blogCategory = new BlogCategory();
        $blogCategory->name = json_encode($name);
        $blogCategory->slug = Str::slug($data['name']);
        $blogCategory->status = $data['status'];
        $blogCategory->save();
        
        if (array_key_exists('image', $data)) {
            $filename = $this->uploadOne($data['image'], 400, 400, 'images/blog_categories', true);
            $image = new Image();
            $image->path = $filename;
            $blogCategory->image()->save($image);
        }
    }
    public function update(array $data, $id)
    {
        $blogCategory = BlogCategory::find($id);
        $newName['en'] = json_decode($blogCategory->name)->en;
        
        foreach ($data['language'] as $key => $language) {
            if ($data['name'][$key]) {
                $newName[$language] = $data['name'][$key];
            }
        }
        
        $blogCategory->name = json_encode($newName);
        $blogCategory->slug = Str::slug($newName['en']);
        $blogCategory->status = $data['status'];
        $blogCategory->save();

        if (array_key_exists('image', $data)){
            $image = $blogCategory->image ?? new Image();
            $this->deleteOne($image->path);
            $filename = $this->uploadOne($data['image'], 400, 300, 'images/blog_categories/', true);
            $image->path = $filename;
            $blogCategory->image()->save($image);
        }
    }
    public function delete($id)
    {
        BlogCategory::find($id)->delete();
    }
    public function statusChange($id)
    {
        $unit = BlogCategory::find($id);
        if($unit->status == 1){
            $unit->status = 0;
        }else{
            $unit->status = 1;
        }
        $unit->save();
    }

    public function restore($id)
    {
        BlogCategory::withTrashed()->find($id)->restore();
    }
    public function onlyTrashed()
    {
        return BlogCategory::onlyTrashed()->get();
    }
    public function forceDelete($id)
    {
        $blogCategory = BlogCategory::withTrashed()->find($id);
        if ($blogCategory) {
            $image = $blogCategory->image;
            $this->deleteOne($image->path);
            $image?->delete();
            $blogCategory->forceDelete();
        }
    }
  
}
