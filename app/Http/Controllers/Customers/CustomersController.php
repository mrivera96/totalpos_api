<?php

namespace App\Http\Controllers\Customers;

use App\Customer;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomersController extends Controller
{
    /**
     * CustomersController constructor.
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
    public function index()
    {
        $customers = Customer::where('status', 1)->get();
        $title = __('Clientes');

        return view('customers.index', compact(['customers', 'title']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = __('Nuevo Cliente');
        $action = route('customer.store');
        $create=true;
        $customers = Customer::where('status', 1)->get();
        $modal=true;
        $modal_title=__('Nuevo Cliente');
        $modal_id='customer-create-modal';
        $modal_close_route=route('customer.index');
        return view('customers.index', compact(['title','action','create','customers',
            'modal_close_route','modal','modal_title', 'modal_id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     *
     */
    public function store(StoreCustomerRequest $request)
    {
        $title = __('Nuevo Cliente');
        try {
            Customer::insert($request->all(['name',
                'last_name',
                'birthday',
                'dni',
                'email',
                'cellphone_number',
                'address']));
            $bg = 'success';
            $alert = 'success';
            $message = __('El cliente ha sido guardado correctamente.');
            $btn = 'success';
            $route = route('customer.index');
            $btn_text = __('Aceptar');


            return view('messages.messages', compact(['bg','alert','message','btn','route', 'btn_text', 'title']));
        } catch (Exception $exception) {
            $bg = 'warning';
            $alert = 'warning';
            $message = __("Ha ocurrido un erro al guardar el cliente. Intenta de nuevo.\n Detalle técnico: ".$exception->getMessage());
            $btn = 'warning';
            $route = url()->previous();
            $btn_text = __('Regresar');

            return view('messages.messages', compact(['bg','alert','message','btn','route', 'btn_text', 'title']));

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
        $customer = Customer::find($id);
        $title=$customer->name;
        $show=true;
        $modal=true;
        $modal_title=$customer->name.' '.$customer->last_name;
        $modal_id='customer-show-modal';
        $customers = Customer::where('status', 1)->get();
        $modal_close_route=route('customer.index');
        return view('customers.index',compact(['title','customer','show','customers',
            'modal_close_route','modal','modal_title', 'modal_id']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $customer = Customer::find($id);
        $title=$customer->name;
        $edit=true;
        $action=route('customer.update',$id);
        $customers = Customer::where('status', 1)->get();
        $modal=true;
        $modal_title=$customer->name.' '.$customer->last_name;
        $modal_id='customer-edit-modal';
        $modal_close_route=route('customer.index');

        return view('customers.index',compact(['title','customer','edit','customers', 'action',
            'modal','modal_title', 'modal_close_route', 'modal_id']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $title = 'Editar Cliente';
        try{
            $customer->update($request->all());
            $bg = 'success';
            $alert = 'success';
            $message = __('El cliente ha sido actualizado correctamente.');
            $btn = 'success';
            $route = route('customer.show', $customer->id);
            $btn_text = __('Aceptar');

            return view('messages.messages', compact(['bg','alert','message','btn','route', 'btn_text', 'title']));

        }catch (Exception $exception){
            $bg = 'warning';
            $alert = 'warning';
            $message = __('Ha ocurrido un error al actualizar el cliente. Intenta de nuevo. Detalle técnico: '.$exception->getMessage());
            $btn = 'warning';
            $route = route(url()->previous());
            $btn_text = __('Regresar');
            return view('messages.messages', compact(['bg','alert','message','btn','route', 'btn_text', 'title']));

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
        $title = __('Eliminar Cliente');
        try{
            $customer=Customer::find($id);
            $customer->update(['status' => 0]);
            $bg = 'success';
            $alert = 'success';
            $message = __('El cliente ha sido eliminado correctamente.');
            $btn = 'success';
            $route = route('customer.index');
            $btn_text = __('Aceptar');

            return view('messages.messages', compact(['bg','alert','message','btn','route', 'btn_text', 'title']));
        }catch (Exception $exception){
            $bg = 'warning';
            $alert = 'warning';
            $message = __('Ha ocurrido un error al actualizar el cliente. Intenta de nuevo. Detalle técnico: '.$exception->getMessage());
            $btn = 'warning';
            $route = route(url()->previous());
            $btn_text = __('Regresar');
        }



    }
}
