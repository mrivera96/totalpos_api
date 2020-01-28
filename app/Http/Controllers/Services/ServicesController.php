<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;
use App\Service;
use App\ServiceProduct;
use App\Http\Requests\StoreServiceRequest;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Servicios';
        $services = Service::all();
        return view('services.index',compact(['title', 'services']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Servicios';
        $services = Service::all();
        $create=true;
        $action=route('service.store');
        $modal = true;
        $modal=true;
        $products=Product::where('status',1)->get();
        $modal_title=__('Nuevo Servicio');
        $modal_id='service-create-modal';
        $modal_close_route=route('service.index');
        return view('services.index',compact(['title', 'services','create','action', 'modal',
            'modal_title', 'modal_id','modal_close_route','products']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreServiceRequest $request)
    {
        try{
            $newService = new Service();
            $newService->name = $request->name;
            $newService->description = $request->description;
            $newService->sale_price = $request->sale_price;
            $newService->name = $request->name;
            if(isset($request->image) && $request->image!=null){
                $imageName = time().'.'.$request->image->getClientOriginalExtension();
                $request->image->move(public_path('img'), $imageName);
                $newService->image      =     $imageName;
            }

            $newService->save();
            if(isset($request->productos) && !empty($request->productos)){

                $productos=json_decode($request->productos[0]);
               
                if(sizeof($productos)>0){
                    foreach($productos as $product){
                        $newServiceProduct = new ServiceProduct();
                        $newServiceProduct->service_id = $newService->id;
                        $newServiceProduct->product_id = $product->product_id;
                        $newServiceProduct->quantity = $product->quantity;
                        $newServiceProduct->save();
                    }
                    
                }
                
            }
            
           return response()->json([
               'error'=>0,
               'message'=>'El servicio ha sido guardado correctamente.'],
               200);

        }catch(Exception $exception){
            return response()->json([
                'error'=>1,
                'message'=>'Ha ocurrido un error al guardar el servicio. Detalle técnico: '.$exception->getMessage()],
                200);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
