<?php

namespace KornerBI\UserManagement\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\RoleHelper;
use App\Services\TableService;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public $service;

    public function __construct(TableService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $res = $this->service->getData($request, RoleHelper::class, Role::class);

        if ($request->ajax()) {
            return response()->json($res);
        }
        return view('admin.roles.index', $res);
    }

    public function create()
    {
        return view('admin.roles.create');
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
                    ->route('admin.roles.show', $role->id)
                    ->withSuccess(__('role.Created successfully'));
            }
        }
        return back()
            ->withFail(__('role.Create failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function show($id)
    {
        return view('admin.roles.show', ['role' => Role::findOrFail($id)]);
    }

    public function edit(Role $role)
    {
        return view('admin.roles.edit', ['role' => $role]);
    }

    public function update(Role $role)
    {
        $validator = $this->validator(request()->all());
        if (!$validator->fails() && $role->update($validator->validated())) {
            return redirect()
                ->route('admin.roles.show', $role->id)
                ->withSuccess(__('role.Updated successfully'));
        }
        return back()
            ->withFail(__('role.Updated failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy($id) {
        $role = Role::findOrFail($id);

        if ($role->delete()) {
            return redirect()
                ->route('admin.roles.index')
                ->withSuccess(__('role.Deleted successfully', [
                    'name' => $role->name,
                    'id' => $role->id
                ]));
        }
        return back()
            ->withFail(__('role.Deleted failed'));
    }

    private function validator(array $all)
    {
        return \Validator::make($all, [
            'name' => 'required|max:191',
            'slug' => 'required|max:191',
        ]);
    }
}
