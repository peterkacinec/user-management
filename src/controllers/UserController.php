<?php

namespace KornerBI\UserManagement\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->toArray();
        return view ('user-management::users.index', ['data' => $users]);
    }

    public function create()
    {
        $user = new User();
        return view('user-management::users.create', ['user' => $user]);
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
                $user->permissions()->sync(request('permissions'));
                return redirect()
                    ->route(config('user-management.route-name-prefix').'users.show', $user->id)
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
        return view('user-management::users.show', ['user' => User::findOrFail($id)]);
    }

    public function edit(User $user)
    {
        return view('user-management::users.edit', ['user' => $user]);
    }

    public function editProfile(User $user)
    {
        if(Auth::id() == $user->id) {
            return view('user-management::users.editProfile', ['user' => $user]);
        }
        return abort(403, __('user-management::general.Unauthorized'));
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
                    ->route(config('user-management.route-name-prefix').'users.show', $user->id)
                    ->withSuccess(__('user-management::general.Updated successfully'));
            }
        }
        return back()
            ->withFail(__('user-management::general.Update failed'))
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
                    ->route(config('user-management.route-name-prefix').'users.editProfile', $user->id)
                    ->withSuccess(__('user-management::general.Updated successfully'));
            }
        }
        return back()
            ->withFail(__('user-management::general.Update failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy($id) {
        $user = User::findOrFail($id);

        if ($user->delete())
        {
            return redirect()
                ->route(config('user-management.route-name-prefix').'users.index')
                ->withSuccess(__('user-management::general.Deleted successfully', [
                    'name'      => $user->name,
                    'surname'   => $user->surname,
                    'id'        => $user->id
                ]));
        }
        return back()
            ->withFail(__('user-management::general.Delete failed', [
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
