<?php

namespace App\Repositories\Interface;
interface CategoryInterface
{
    public function all();
    public function store(array $data);
    public function update(array $data,$slug);
    public function delete($slug);
    public function restore($slug);
    public function forceDelete($slug);
    public function onlyTrashed();
}
