<?php

namespace KornerBI\UserManagement\Controllers;

use App\Http\Controllers\Controller;
use KornerBI\UserManagement\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::all()->toArray();
        return view('user-management::permissions.index', ['data' => $permissions]);
    }

    public function create()
    {
        return view('user-management::permissions.create');
    }

    /**
     * Store a new user.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store()
    {
        $validator = $this->validator(request()->all());
        if (!$validator->fails()) {
            $permission = new Permission($validator->validated());

            if ($permission->save()) {
                return redirect()
                    ->route(config('user-management.route-name-prefix').'permissions.show', $permission->id)
                    ->withSuccess(__('user-management::general.Created successfully'));
            }
        }
        return back()
            ->withFail(__('user-management::general.Create failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function show($id)
    {
        return view('user-management::permissions.show', ['permission' => Permission::findOrFail($id)]);
    }

    public function edit(Permission $permission)
    {
        return view('user-management::permissions.edit', ['permission' => $permission]);
    }

    public function update(Permission $permission)
    {
        $validator = $this->validator(request()->all());
        if (!$validator->fails() && $permission->update($validator->validated())) {
            return redirect()
                ->route(config('user-management.route-name-prefix').'permissions.show', $permission->id)
                ->withSuccess(__('user-management::general.Updated successfully'));
        }
        return back()
            ->withFail(__('user-management::general.Update failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy($id) {
        $permission = Permission::findOrFail($id);

        if ($permission->delete()) {
            return redirect()
                ->route(config('user-management.route-name-prefix').'permissions.index')
                ->withSuccess(__('user-management::general.Deleted successfully', [
                    'name' => $permission->name,
                    'id' => $permission->id
                ]));
        }
        return back()
            ->withFail(__('user-management::general.Delete failed'));
    }

    private function validator(array $all)
    {
        return \Validator::make($all, [
            'name' => 'required|max:191',
            'slug' => 'required|max:191',
        ]);
    }
}
