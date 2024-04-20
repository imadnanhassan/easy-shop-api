<?php
namespace App\Repositories;
use App\Models\Admin;
use App\Repositories\Interface\StaffInterface;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffRepositories implements StaffInterface
{
    public function all(){
        return Admin::whereNotIn('id',[1])->orderBy('id','desc')->paginate(10);
    }
    public function store(array $data){

        $staff = new Admin();
        $staff->name = $data['name'];
        $staff->username = $data['username'];
        $staff->email  = $data['email'];
        $staff->phone_number  = $data['phone_number'];
        $staff->password  = Hash::make($data['password']);
        $staff->save();
    }
    public function update(array $data,$id){
        $staff =  Admin::find($id);
        $staff->name = $data['name'];
        $staff->username = $data['username'];
        $staff->email  = $data['email'];
        $staff->phone_number  = $data['phone_number'];
        $staff->password  = Hash::make($data['password']);
        $staff->save();
    }
    public function delete($id){
        $staff =  Admin::find($id);
        if(!empty($staff)){
            $staff->delete();
        }
    }

}
