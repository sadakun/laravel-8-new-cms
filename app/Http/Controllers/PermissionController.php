<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index()
    {
        return view('admin.permissions.index', [
            'permissions'=> Permission::all()
        ]);
    }

    public function store()
    {
        request()->validate([
            'name'=>['required']
        ]);
        Permission::create([
            'name'=>Str::ucfirst(request('name')),
            'slug'=>Str::of(Str::lower(request('name')))->slug('-'),
        ]);
        return back();
    }

    public function edit(Permission $permission)
    {
        return view('admin.permissions.edit', ['permission'=>$permission]);
    }

    public function delete(Permission $permission)
    {
        $permission->delete();
        return back();
    }

    public function update(Permission $permission)
    {
        $permission->name = Str::ucfirst(request('name'));
        $permission->slug = Str::of(Str::lower(request('name')))->slug('-');
        if($permission->isDirty('name'))
        {
            session()->flash('permission-updated', $permission->name. ' '. 'permission updated');
            $permission->save();
        } else {
            session()->flash('permission-updated', 'nothing has been updating');
        }
        
        return redirect()->route('permissions.index');
    }

}
