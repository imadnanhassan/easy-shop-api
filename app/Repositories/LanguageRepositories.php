<?php

namespace App\Repositories;
use App\Models\Image;
use App\Models\Language;
use App\Repositories\Interface\LanguageInterface;
use App\Traits\Uploadable;

class LanguageRepositories implements LanguageInterface
{
    use Uploadable;

    public function all()
    {
        return Language::get();
    }

    public function store(array $data)
    {
        
        $language = new Language();
        $language->name = $data['name'];
        $language->code = $data['code'];
        $language->save();

        if (array_key_exists('image', $data)){
            $image = new Image();
            $image->path = $this->uploadOne($data['image'], 400, 300, 'images/flags/', true);
            $language->image()->save($image);
        }
    }

    public function update(array $data, $id){
        $language = Language::find($id);
        $language->name = $data['name'];
        $language->code = $data['code'];
        $language->save();
        if (array_key_exists('image', $data)){
            $image = $language->image ?? new Image();
            $this->deleteOne($image->path);
            $filename = $this->uploadOne($data['image'], 400, 300, 'images/flags/', true);
            $image->path = $filename;
            $language->image()->save($image);
        }
    }

    public function delete($id): void
    {
        $language = Language::find($id);
        $image = $language->image;
        $this->deleteOne($image->path);
        $image?->delete();
        $language?->delete();
    }
}
