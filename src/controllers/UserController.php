<?php

namespace KornerBI\UserManagement\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use KornerBI\UserManagement\SimpleTable;

class UserController extends Controller
{
    public $service;

    public function index(Request $request)
    {
        $users = User::all()->toArray();
        $columns = ['name', 'surname'];
        $table = new SimpleTable($columns, $users);

//        $res = $this->service->getData($request, UserHelper::class, User::class);
//
//        if ($request->ajax()) {
//            return response()->json($res);
//        }
//        return view('user_management::admin.users.index', $res);
    }

    public function create()
    {
        $user = new User();
        return view('user_management::users.create', ['user' => $user]);
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
            $user = new User($validator->validated());
            $user->password = request('password') ? bcrypt(request('password')) : $user->password;

            if ($user->save()) {
                $user->roles()->sync(request('roles'));
                return redirect()
                    ->route('users.show', $user->id)
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
        return view('user_management::users.show', ['user' => User::findOrFail($id)]);
    }

    public function edit(User $user)
    {
        return view('user_management::users.edit', ['user' => $user]);
    }

    public function editProfile(User $user)
    {
        if(Auth::id() == $user->id) {
            return view('user_management::users.editProfile', ['user' => $user]);
        }
        return abort(403, __('user_management::general.Unauthorized'));
    }

    public function update(User $user)
    {
        $validator = $this->validator(request()->all(), $user->id);
        if (!$validator->fails())
        {
            $user->name     = request('name');
            $user->surname  = request('surname');
            $user->email    = request('email');
            $user->password = request('password') ? bcrypt(request('password')) : $user->password;
            $user->roles()->sync(request('roles'));
            $user->permissions()->sync(request('permissions'));

            if ($user->save()) {
                return redirect()
                    ->route('users.show', $user->id)
                    ->withSuccess(__('user_management::general.Updated successfully'));
            }
        }
        return back()
            ->withFail(__('user_management::general.Update failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function updateProfile(User $user)
    {
        $validator = $this->validator(request()->all());
        if (!$validator->fails())
        {
            $user->name     = request('name');
            $user->surname  = request('surname');
            $user->password = request('password') ? bcrypt(request('password')) : $user->password;

            if ($user->update()) {
                return redirect()
                    ->route('users.editProfile', $user->id)
                    ->withSuccess(__('user_management::general.Updated successfully'));
            }
        }
        return back()
            ->withFail(__('user_management::general.Update failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy($id) {
        $user = User::findOrFail($id);

        if ($user->delete())
        {
            return redirect()
                ->route('users.index')
                ->withSuccess(__('user_management::general.Deleted successfully', [
                    'name'      => $user->name,
                    'surname'   => $user->surname,
                    'id'        => $user->id
                ]));
        }
        return back()
            ->withFail(__('user_management::general.Delete failed', [
                'name'      => $user->name,
                'surname'   => $user->surname,
                'id'        => $user->id
            ]));
    }

    private function validator(array $all, $id = null)
    {
        return \Validator::make($all, [
            'name'      => 'required|max:191',
            'surname'   => 'required|max:191',
            'password'  => 'nullable|min:6|confirmed',
            'email'     => 'nullable|email|unique:users,email,'.$id
        ]);
    }
}
