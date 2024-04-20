<?php
namespace App\Repositories;

use App\Models\Attribute;
use App\Repositories\Interface\AttributeInterface;

class AttributeRepositories implements AttributeInterface
{
    public function all(){
       
        return Attribute::orderBy('id','desc')->paginate(10);
    }

    public function store(array $data){
        $name['en'] = $data['name'];
        $attribute = new Attribute();
        $attribute->name = json_encode($name);
        $attribute->save();
    }

    public function update(array $data,$id){
        $attribute = Attribute::find($id);
        
        $newName['en'] = json_decode($attribute->name)->en;

        foreach ($data['language'] as $key => $language) {
            if ($data['name'][$key]) {
                $newName[$language] = $data['name'][$key];
            }
        }
        $attribute->name = json_encode($newName);
        $attribute->save();
    }
    public function delete($id){
        Attribute::find($id)->delete();
    }
}
