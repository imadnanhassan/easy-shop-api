<?php

namespace App\Repositories\Interface;
interface AttributeValueInterface
{
    public function all();
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);
    public function restore($id);
    public function onlyTrashed();
    public function forceDelete($id);
}
