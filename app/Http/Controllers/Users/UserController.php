<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Branch;
use Illuminate\Support\Facades\Auth;
use Exception;

class UserController extends Controller
{
    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (auth()->user()->role->id != 1) {
            redirect('/dashboard');
        }

        if ($request->ajax()) {
            $users = User::where('status', 1)->get();
            foreach($users as $usr){
                 $usr->role;
            }
            return response()->json([
                'error' => 0,
                'users' => $users
            ],
                200);
        }

        $title = 'Usuarios';
        return view('users.index', compact('title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Nuevo usuario';
        $roles = Role::all();
        $branchs = Branch::all();
        $action = route('user.store');
        $modal = true;
        $modal_title = __('Nuevo Usuario');
        $modal_id = 'user-create-modal';
        $modal_close_route = route('user.index');
        $create = true;
        $users = User::where('status', 1)->get();
        return view('users.index', compact(['title', 'users', 'roles', 'branchs', 'action',
            'modal_close_route', 'modal', 'modal_title', 'modal_id', 'create']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->last_name = $request->last_name;
        $user->username = $request->username;
        $user->dni = $request->dni;
        $user->birthday = $request->birthday;
        $user->register_date = Carbon::now();
        $user->mobile = $request->mobile;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;
        $user->branch_id = $request->branch_id;

        if (isset($request->avatar) && $request->avatar != null) {
            $imageName = time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('img'), $imageName);
            $user->avatar = $imageName;
        }

        try {
            $user->save();
            $bg = 'success';
            $alert = 'success';
            $message = __('El usuario ha sido guardado correctamente.');
            $btn = 'success';
            $route = route('user.index');
            $btn_text = __('Aceptar');
            $title = 'Nuevo Usuario';
            return view('messages.messages', compact(['bg', 'alert', 'message', 'btn', 'route', 'btn_text', 'title']));
        } catch (Exception $exception) {
            $bg = 'warning';
            $alert = 'warning';
            $message = __("Ha ocurrido un erro al guardar el usuario. Intenta de nuevo.\n Detalle técnico: " . $exception->getMessage());
            $btn = 'warning';
            $route = url()->previous();
            $btn_text = __('Regresar');
            $title = __('Nuevo Usuario');

            return view('messages.messages', compact(['bg', 'alert', 'message', 'btn', 'route', 'btn_text', 'title']));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $title = $user->name;
        $modal = true;
        $modal_title = $user->name . ' ' . $user->last_name;
        $modal_id = 'user-show-modal';
        $modal_close_route = route('user.index');
        $users = User::where('status', 1)->get();
        $show = true;
        return view('users.index', compact(['title', 'user', 'users', 'modal_close_route', 'modal',
            'modal_title', 'modal_id', 'show']));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $title = __('Editar Usuario');
        $action = route('user.update', $user);
        $modal = true;
        $modal_title = $user->name . ' ' . $user->last_name;
        $modal_id = 'user-edit-modal';
        $modal_close_route = route('user.index');
        $users = User::where('status', 1)->get();
        $edit = true;

        return view('users.index', compact(['title', 'user', 'action',
            'users', 'modal_close_route', 'modal',
            'modal_title', 'modal_id', 'edit']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if (isset($request->avatar) && $request->avatar != null) {
            $imageName = time() . '.' . $request->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('img'), $imageName);
            $user->avatar = $imageName;
        }
        try {
            $user->update($request->all());
            $bg = 'success';
            $alert = 'success';
            $message = __('El usuario ha sido actualizado correctamente.');
            $btn = 'success';
            $route = route('user.show', $user->id);
            $btn_text = __('Aceptar');
            $title = __('Editar Usuario');

            return view('messages.messages', compact(['bg', 'alert', 'message', 'btn', 'route', 'btn_text', 'title']));
        } catch (Exception $exception) {
            $bg = 'warning';
            $alert = 'warning';
            $message = __("Ha ocurrido un erro al actualizar el usuario. Intenta de nuevo.\n Detalle técnico: " . $exception->getMessage());
            $btn = 'warning';
            $route = url()->previous();
            $btn_text = __('Regresar');
            $title = __('Editar Usuario');

            return view('messages.messages', compact(['bg', 'alert', 'message', 'btn', 'route', 'btn_text', 'title']));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $title = __('Eliminar usuario');

        if ($id == 1) {
            $bg = 'danger';
            $alert = 'danger';
            $message = __('Lo sentimos, el usuario Administrador no puede ser eliminado.');
            $btn = 'danger';
            $route = route('user.index');
            $btn_text = __('Aceptar');

        } else if ($id == Auth::user()->id) {
            $user = User::find($id);
            $user->update(['status' => 0]);
            Auth::logout();
        } else {
            $user = User::find($id);
            $user->update(['status' => 0]);
            $bg = 'success';
            $alert = 'success';
            $message = __('El usuario ha sido eliminado correctamente.');
            $btn = 'success';
            $route = route('user.index');
            $btn_text = __('Aceptar');
        }

        return view('messages.messages', compact(['bg', 'alert', 'message', 'btn', 'route', 'btn_text', 'title']));

    }

}
