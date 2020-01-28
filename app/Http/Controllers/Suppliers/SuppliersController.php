<?php

namespace App\Http\Controllers\Suppliers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use Illuminate\Http\Request;
use App\Supplier;
use Exception;
use Illuminate\Support\Facades\Route;

class SuppliersController extends Controller
{
    /**
     * SuppliersController constructor.
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
        $title = 'Proveedores';
        $suppliers = Supplier::where('status', 1)->get();

        return view('suppliers.index', compact(['title', 'suppliers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Nuevo Proveedor';
        $action = route('supplier.store');
        $create=true;
        $suppliers = Supplier::where('status', 1)->get();
        $modal=true;
        $modal_title=__('Nuevo Proveedor');
        $modal_id='supplier-create-modal';
        $modal_close_route=route('supplier.index');

        return view('suppliers.index', compact(['title', 'action'
            ,'create','suppliers', 'modal_close_route','modal',
            'modal_title', 'modal_id']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplierRequest $supplier)
    {
        $title = 'Nuevo Proveedor';
        try{
            Supplier::insert($supplier->all(['name', 'description','phone_number', 'address', 'email']));
            $bg = 'success';
            $alert = 'success';
            $message = __('El proveedor ha sido guardado correctamente.');
            $btn = 'success';
            $route = route('supplier.index');
            $btn_text = __('Aceptar');

            return view('messages.messages', compact(['bg','alert','message','btn','route', 'btn_text', 'title']));

        }catch(Exception $exception){
            $bg = 'warning';
            $alert = 'warning';
            $message = __("Ha ocurrido un erro al guardar el proveedor. Intenta de nuevo.\n Detalle técnico: ".$exception->getMessage());
            $btn = 'warning';
            $route = url()->previous();
            $btn_text = __('Regresar');

            return view('messages.messages', compact(['bg','alert','message','btn','route', 'btn_text', 'title']));

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::find($id);
        $title = $supplier->name;
        $show=true;
        $suppliers = Supplier::where('status', 1)->get();
        $modal=true;
        $modal_title=$supplier->name;
        $modal_id='supplier-show-modal';
        $modal_close_route=route('supplier.index');
        return view('suppliers.index', compact(['title','supplier',
            'show','suppliers', 'modal_close_route','modal','modal_title', 'modal_id']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $title = 'Editar Proveedor';
        $action = route('supplier.update', $supplier);
        $edit=true;
        $suppliers = Supplier::where('status', 1)->get();
        $modal=true;
        $modal_title=$supplier->name;
        $modal_id='supplier-edit-modal';
        $modal_close_route=route('supplier.index');
        return view('suppliers.index', compact(['title', 'supplier',
            'edit','suppliers', 'modal_close_route','modal','modal_title', 'modal_id','action']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $title = 'Editar Proveedor';
        try{
            $supplier->update($request->all());
            $bg = 'success';
            $alert = 'success';
            $message = __('El proveedor ha sido actualizado correctamente.');
            $btn = 'success';
            $route = route('supplier.show', $supplier->id);
            $btn_text = __('Aceptar');

            return view('messages.messages', compact(['bg','alert','message','btn','route', 'btn_text', 'title']));

        }catch (Exception $exception){
            $bg = 'warning';
            $alert = 'warning';
            $message = __('Ha ocurrido un error al actualizar el proveedor. Intenta de nuevo. Detalle técnico: '.$exception->getMessage());
            $btn = 'warning';
            $route = route(url()->previous());
            $btn_text = __('Regresar');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $title = 'Eliminar Proveedor';

        try{
            $supplier->update(['status' => 0]);
            $bg = 'success';
            $alert = 'success';
            $message = __('El proveedor ha sido eliminado correctamente.');
            $btn = 'success';
            $route = route('supplier.index');
            $btn_text = __('Aceptar');

            return view('messages.messages', compact(['bg','alert','message','btn','route', 'btn_text', 'title']));
        }catch (Exception $exception){
            $bg = 'warning';
            $alert = 'warning';
            $message = __('Ha ocurrido un error al eliminar el proveedor. Intenta de nuevo. Detalle técnico: '.$exception->getMessage());
            $btn = 'warning';
            $route = route('supplier.show', $supplier->id);
            $btn_text = __('Aceptar');

            return view('messages.messages', compact(['bg','alert','message','btn','route', 'btn_text', 'title']));

        }
    }
}
