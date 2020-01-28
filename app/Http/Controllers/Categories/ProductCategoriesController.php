<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoriesController extends Controller
{
    /**
     * ProductCategoriesController constructor.
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
        $title = 'Categorías de Productos';

        $categories = ProductCategory::all();

        return view('categories.index', compact(['title', 'categories']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $category)
    {
        $newCategory = new ProductCategory();
        $newCategory->description   =   $category->description;
        $status = 0;
        if($newCategory->save()){
            $status = 1;
        }
        $title='Nueva Categoría';

        return view('messages.categoryCreate', compact(['status', 'title']));
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
    public function update(CategoryRequest $request, ProductCategory $category)
    {

        $category->description = $request->description;

        $status = 0;
        if($category->save()){
            $status = 1;
        }


        $title='Editar Categoría';

        return view('messages.categoryEdit', compact(['status', 'title']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductCategory $category)
    {

        $status = 0;
        if($category->delete()){
            $status = 1;
        }


        $title='Eliminar Categoría';

        return view('messages.categoryDelete', compact(['status', 'title']));
    }
}
