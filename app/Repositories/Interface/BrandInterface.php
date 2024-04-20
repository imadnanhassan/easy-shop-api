<?php

namespace App\Repositories\Interface;
interface BrandInterface
{
    public function all();
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);
    public function statusChange($id);
}
