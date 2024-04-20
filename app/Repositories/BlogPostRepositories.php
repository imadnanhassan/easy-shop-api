<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\BlogPost;
use App\Traits\Uploadable;
use Illuminate\Support\Str;
use App\Repositories\Interface\BlogPostInterface;

class BlogPostRepositories implements BlogPostInterface
{
    use Uploadable;
    public function all()
    {
        return BlogPost::orderBy('id', 'desc')->paginate(10);
    }
    public function store(array $data)
    {
        $filename = null;
        if (array_key_exists('image', $data)) {
            $filename = $this->uploadOne($data['image'], 400, 400, 'images/blog_posts', true);
        }

        $title['en'] = $data['title'];
        $short_description['en'] = $data['short_description'];
        $long_description['en'] = $data['long_description'];

        $blogPost = new BlogPost();
        $blogPost->blog_category_id = $data['blog_category_id'];
        $blogPost->blog_tag_id = $data['blog_tag_id'];
        $blogPost->title = json_encode($title);
        $blogPost->slug = Str::slug($data['title']);
        $blogPost->status = $data['status'];
        $blogPost->priority = $data['priority'];
        $blogPost->short_description = json_encode($short_description);
        $blogPost->long_description = json_encode($long_description);
      
        $blogPost->save();

        if (array_key_exists('image', $data)){
            $image = new Image();
            $image->path = $this->uploadOne($data['image'], 400, 300, 'images/blog_posts/', true);
            $blogPost->image()->save($image);
        }
    }
    public function update(array $data, $id)
    {
        $blogPost = BlogPost::find($id);


        $newTitle['en'] = json_decode($blogPost->title)->en;
        $newShortDescription['en'] = json_decode($blogPost->short_description)->en;
        $newLongDescription['en'] = json_decode($blogPost->long_description)->en;

        foreach ($data['language'] as $key => $language) {
            if ($data['title'][$key]) {
                $newTitle[$language] = $data['title'][$key];
            }
            if ($data['short_description'][$key]) {
                $newShortDescription[$language] = $data['short_description'][$key];
            }
            if ($data['long_description'][$key]) {
                $newLongDescription[$language] = $data['long_description'][$key];
            }
        }

        $blogPost->blog_category_id = $data['blog_category_id'];
        $blogPost->blog_tag_id = $data['blog_tag_id'];
        $blogPost->title = json_encode($newTitle);
        $blogPost->short_description = json_encode($newShortDescription);
        $blogPost->long_description = json_encode($newLongDescription);
        $blogPost->slug = Str::slug($newTitle['en']);
        $blogPost->status = $data['status'];
        $blogPost->priority = $data['priority'];
       
        if (array_key_exists('image', $data)){
            $image = $blogPost->image ?? new Image();
            $this->deleteOne($image->path);
            $filename = $this->uploadOne($data['image'], 400, 300, 'images/blog_posts/', true);
            $image->path = $filename;
            $blogPost->image()->save($image);
        }

        $blogPost->save();
    }
    public function delete($id)
    {

        $blogpost = BlogPost::withTrashed()->find($id);
        if ($blogpost) {
            
            $image = $blogpost->image;
            $filename = $image->path;
            $this->deleteOne($filename);
            $image->delete();
            
            $blogpost->forceDelete();
        }
    }

    public function statusChange($id)
    {
        $unit = BlogPost::find($id);
        if ($unit->status == 1) {
            $unit->status = 0;
        } else {
            $unit->status = 1;
        }
        $unit->save();
    }

    public function restore($id)
    {
        BlogPost::withTrashed()->find($id)->restore();
    }
    public function onlyTrashed()
    {
        return BlogPost::onlyTrashed()->get();
    }
    public function forceDelete($id)
    {
        $blogPost = BlogPost::withTrashed()->find($id);
        if ($blogPost) {
            $filename = $blogPost->image;
            $this->deleteOne('images/blog_posts/', $filename);
            $blogPost->forceDelete();
        }
    }
}
