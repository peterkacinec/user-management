<?php

namespace KornerBI\UserManagement\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Helpers\UserHelper;
use App\Services\TableService;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public $service;

    public function __construct(TableService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $res = $this->service->getData($request, UserHelper::class, User::class);

        if ($request->ajax()) {
            return response()->json($res);
        }
        return view('admin.users.index', $res);
    }

    public function create()
    {
        $user = new User();
        return view('admin.users.create', ['user' => $user]);
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
                return redirect()
                    ->route('admin.users.show', $user->id)
                    ->withSuccess(__('user.Created successfully'));
            }
        }
        return back()
            ->withFail(__('general.Update failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function show($id)
    {
        return view('admin.users.show', ['user' => User::findOrFail($id)]);
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', ['user' => $user]);
    }

    public function editProfile(User $user)
    {
        $this->authorize('is-user', $user);
        return view('admin.users.editProfile', ['user' => $user]);
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

            if ($user->save()) {
                return redirect()
                    ->route('admin.users.show', $user->id)
                    ->withSuccess(__('general.Updated successfully'));
            }
        }
        return back()
            ->withFail(__('general.Update failed'))
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
                    ->route('admin.users.editProfile', $user->id)
                    ->withSuccess(__('general.Updated successfully'));
            }
        }
        return back()
            ->withFail(__('general.Update failed'))
            ->withErrors($validator)
            ->withInput();
    }

    public function destroy($id) {
        $user = User::findOrFail($id);

        if ($user->delete())
        {
            return redirect()
                ->route('admin.users.index')
                ->withSuccess(__('user.Deleted successfully', [
                    'name'      => $user->name,
                    'surname'   => $user->surname,
                    'id'        => $user->id
                ]));
        }
        return back()
            ->withFail(__('user.Deleted failed', [
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
