<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\Slider;
use App\Traits\Uploadable;
use App\Repositories\Interface\SliderInterface;

class SliderRepositories implements SliderInterface
{
    use Uploadable;
    public function all()
    {
        return Slider::orderBy('id', 'desc')->paginate(10);
    }
    public function store(array $data)
    {
        $title['en'] = $data['title'];
        $short_description['en'] = $data['short_description'];
        
        $slider = new Slider();
        $slider->title = json_encode($title);
        $slider->short_description = json_encode($short_description);
        $slider->link = $data['link'];
        $slider->status = $data['status'];
        $slider->priority = $data['priority'];
        $slider->save();
        
        if (array_key_exists('image', $data)){
            $image = new Image();
            $image->path = $this->uploadOne($data['image'], 400, 300, 'images/sliders/', true);
            $slider->image()->save($image);
        }

    }
    public function update(array $data, $id)
    {
        $slider = Slider::find($id);


        $newTitle['en'] = json_decode($slider->title)->en;
        $newDescription['en'] = json_decode($slider->short_description)->en;

        foreach ($data['language'] as $key => $language) {
            if ($data['title'][$key]) {
                $newTitle[$language] = $data['title'][$key];
            }
            if ($data['short_description'][$key]) {
                $newDescription[$language] = $data['short_description'][$key];
            }
        }

        $slider->title = json_encode($newTitle);
        $slider->short_description = json_encode($newDescription);
        $slider->link = $data['link'];
        $slider->status = $data['status'];
        $slider->priority = $data['priority'];
        
        if (array_key_exists('image', $data)){
            $image = $slider->image ?? new Image();
            $this->deleteOne($image->path);
            $filename = $this->uploadOne($data['image'], 400, 300, 'images/sliders/', true);
            $image->path = $filename;
            $slider->image()->save($image);
        }
        
        $slider->save();
    }
    public function delete($id)
    {
        $slider = Slider::find($id);
        $image = $slider->image;
        $this->deleteOne($image->path);
        $image?->delete();
        $slider?->delete();
    }
    public function statusChange($id)
    {
        $unit = Slider::find($id);
        if ($unit->status == 1) {
            $unit->status = 0;
        } else {
            $unit->status = 1;
        }
        $unit->save();
    }

    public function restore($id)
    {
        Slider::withTrashed()->find($id)->restore();
    }
    public function onlyTrashed()
    {
        return Slider::onlyTrashed()->get();
    }
    public function forceDelete($id)
    {
        $slider = Slider::withTrashed()->find($id);
        if ($slider) {
            
            $image = $slider->image;
            $filename = $image->path;
            $this->deleteOne($filename);
            $image->delete();
            
            $slider->forceDelete();
        }
    }
}
