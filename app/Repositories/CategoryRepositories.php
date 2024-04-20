<?php

namespace App\Repositories;
use App\Models\Image;
use App\Models\Category;
use App\Repositories\Interface\CategoryInterface;
use App\Traits\Uploadable;
use Illuminate\Support\Str;

class CategoryRepositories implements CategoryInterface
{
    use Uploadable;

    public function all()
    {
        return Category::get();
    }

    public function store(array $data): void
    {
        $category = new Category();
        $name['en'] = $data['name'];
        $category->name = json_encode($name);
        $category->slug = Str::slug($data['name']);
        $category->status = $data['status'];
        $category->priority = $data['priority'];
        if ($data['parent_id']) {
            $parent = Category::find($data['parent_id']);
            if ($parent->level < 2) {
                $category->level = $parent->level + 1;
                $category->parent_id = $data['parent_id'];
            }
        }
        $category->save();
        if (array_key_exists('image', $data)){
            $image = new Image();
            $image->path = $this->uploadOne($data['image'], 400, 300, 'images/categories/', true);
            $category->image()->save($image);
        }
    }

    public function update(array $data, $slug): void
    {
        $category = Category::where('slug', $slug)->first();
        $newName['en'] = json_decode($category->name)->en;
        foreach ($data['name'] as $key => $name) {
            if ($name) {
                $newName[$data['language'][$key]] = $name;
            }
        }
        if ($data['parent_id']) {
            $parent = Category::find($data['parent_id']);
            if ($parent->level < 2) {
                $category->level = $parent->level + 1;
                $category->parent_id = $data['parent_id'];
            }
            else {
                $category->level = 0;
                $category->parent_id = null;
            }
        }
        else {
            $category->level = 0;
            $category->parent_id = null;
        }
        $category->name = json_encode($newName);
        $category->slug = Str::slug($newName['en']);
        $category->status = $data['status'];
        $category->priority = $data['priority'];
        $category->save();

        if (array_key_exists('image', $data)){
            $image = $category->image ?? new Image();
            $this->deleteOne($image->path);
            $image->path = $this->uploadOne($data['image'], 400, 300, 'images/categories/', true);
            $category->image()->save($image);
        }

    }

    public function delete($slug): void
    {
        Category::where('slug', $slug)->first()?->delete();
    }

    public function restore($slug): void
    {
        Category::withTrashed()->where('slug', $slug)->first()?->restore();
    }

    public function onlyTrashed(): array|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
    {
        return Category::onlyTrashed()->get();
    }

    public function forceDelete($slug): void
    {
        $category = Category::withTrashed()->where('slug', $slug)->first();
        if ($category) {
            $filename = $category->image;
            $this->deleteOne('images/categories/', $filename);
            $category->forceDelete();
        }
    }
}
