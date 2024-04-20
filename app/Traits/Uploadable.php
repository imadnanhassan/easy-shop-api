<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait Uploadable
{
    public function uploadOne(UploadedFile $file, int $width, int $height, string $folder = 'images/', bool $originalExtension = false): string
    {
        $generateName = date('ymd') . '-' . strtoupper(Str::random(6));
        if ($originalExtension) {
            $generateNameWithExt = $generateName . "." . $file->getClientOriginalExtension();
        } else {
            $generateNameWithExt = $generateName . "." . 'webp';
        }
        if (!File::exists(public_path($folder))) {
            File::makeDirectory(public_path($folder), 0777, true);
        }
        Image::make($file)->resize($width, $height)->save(public_path($folder . $generateNameWithExt)); //resizing image
        return $folder . $generateNameWithExt;
    }
    /**
     * @param null $path
     * @param string $disk
     */
    public function deleteOne($filename): void
    {
        File::delete(public_path($filename));
    }
}
