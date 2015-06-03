<?php

namespace LittleNinja\Http\Controllers\Admin;

use LittleNinja\Http\Controllers\Controller;
use LittleNinja\User;
use Redirect;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::withTrashed()->paginate(30);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @param UsersRequest $request
     * @return Response
     */
    public function update($id, UsersRequest $request)
    {
        $user = User::find($id);
        $user->update($request->all());

        return redirect('admin/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return Redirect::back();
    }

    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        $user->restore();

        return Redirect::back();
    }
}
