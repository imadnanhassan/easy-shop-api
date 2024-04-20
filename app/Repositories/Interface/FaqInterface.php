<?php

namespace App\Repositories\Interface;

interface FaqInterface
{
    public function all();
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);
    public function statusChange($id);
    public function restore($id);
    public function forceDelete($id);
    public function onlyTrashed();
}
