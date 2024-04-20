<?php

namespace App\Repositories;

use App\Models\AttributeValue;
use App\Repositories\Interface\AttributeValueInterface;

class AttributeValueRepositories implements AttributeValueInterface
{
    public function all()
    {
        return AttributeValue::orderBy('id', 'desc')->paginate(10);
    }
    public function store(array $data)
    {
        $name['en'] = $data['name'];
        $attributeValue = new AttributeValue();
        $attributeValue->name = json_encode($name);
        $attributeValue->attribute_id = $data['attribute_id'];
        $attributeValue->save();
    }
    public function update(array $data, $id)
    {
        $attributeValue = AttributeValue::find($id);

        $newName['en'] = json_decode($attributeValue->name)->en;
        foreach ($data['language'] as $key => $language) {
            if ($data['name'][$key]) {
                $newName[$language] = $data['name'][$key];
            }
        }
        $attributeValue->name = json_encode($newName);
        $attributeValue->attribute_id = $data['attribute_id'];
        $attributeValue->save();
    }
    public function delete($id)
    {
        AttributeValue::find($id)->delete();
    }
    public function restore($id)
    {
        AttributeValue::withTrashed()->find($id)->restore();
    }
    public function onlyTrashed()
    {
        return AttributeValue::onlyTrashed()->get();
    }
    public function forceDelete($id)
    {
        $value = AttributeValue::withTrashed()->find($id);
        if ($value) {
            $value->forceDelete();
        }
    }
}
