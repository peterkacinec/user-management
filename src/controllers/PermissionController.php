<?php

namespace KornerBI\UserManagement\Controllers;

use App\Http\Controllers\Controller;
use KornerBI\UserManagement\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public $service;
//
//    public function __construct(TableService $service)
//    {
//        $this->service = $service;
//    }

    public function index(Request $request)
    {
        $res = $this->service->getData($request, RoleHelper::class, Role::class);

        if ($request->ajax()) {
            return response()->json($res);
        }
        return view('user_management::permissions.index', $res);
    }

    public function create()
    {
        return view('user_management::permissions.create');
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
                    ->route('permissions.show', $permission->id)
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
        return view('user_management::permissions.show', ['permission' => Permission::findOrFail($id)]);
    }

    public function edit(Permission $permission)
    {
        return view('user_management::permissions.edit', ['permission' => $permission]);
    }

    public function update(Permission $permission)
    {
        $validator = $this->validator(request()->all());
        if (!$validator->fails() && $permission->update($validator->validated())) {
            return redirect()
                ->route('permissions.show', $permission->id)
                ->withSuccess(__('user_management::general.Updated successfully'));
        }
        return back()
            ->withFail(__('user_management::general.Update failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy($id) {
        $permission = Permission::findOrFail($id);

        if ($permission->delete()) {
            return redirect()
                ->route('permissions.index')
                ->withSuccess(__('user_management::general.Deleted successfully', [
                    'name' => $permission->name,
                    'id' => $permission->id
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
