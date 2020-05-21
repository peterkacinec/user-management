<?php

namespace KornerBI\UserManagement\Controllers;

use App\Http\Controllers\Controller;
use KornerBI\UserManagement\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::all()->toArray();
        return view ('user_management::roles.index', ['data' => $roles]);
    }

    public function create()
    {
        return view('user_management::roles.create');
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
            $role = new Role($validator->validated());

            if ($role->save()) {
                return redirect()
                    ->route('roles.show', $role->id)
                    ->withSuccess(__('user_management::general.Created successfully'));
            }
        }
        return back()
            ->withFail(__('user_management::general.Create failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function show($id)
    {
        return view('user_management::roles.show', ['role' => Role::findOrFail($id)]);
    }

    public function edit(Role $role)
    {
        return view('user_management::roles.edit', ['role' => $role]);
    }

    public function update(Role $role)
    {
        $validator = $this->validator(request()->all());
        if (!$validator->fails() && $role->update($validator->validated())) {
            return redirect()
                ->route('roles.show', $role->id)
                ->withSuccess(__('user_management::general.Updated successfully'));
        }
        return back()
            ->withFail(__('user_management::general.Update failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy($id) {
        $role = Role::findOrFail($id);

        if ($role->delete()) {
            return redirect()
                ->route('roles.index')
                ->withSuccess(__('user_management::general.Deleted successfully', [
                    'name' => $role->name,
                    'id' => $role->id
                ]));
        }
        return back()
            ->withFail(__('user_management::general.Delete failed'));
    }

    private function validator(array $all)
    {
        return \Validator::make($all, [
            'name' => 'required|max:191',
            'slug' => 'required|max:191',
        ]);
    }
}
