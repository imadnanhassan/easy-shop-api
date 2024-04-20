<?php

namespace App\Repositories\Interface;
interface StaffInterface
{
    public function all();
    public function store(array $data);
    public function update(array $data,$id);
    public function delete($id);

}
