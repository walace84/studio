<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::ClientProd();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->all();
        // formata a moeda
        $valueFormt = str_replace(',','.',str_replace('.','',$data['price'])); 

        $data['price'] = $valueFormt;

        $create = Product::create($data);
        if($create != ''){
            return redirect()->route('home')->with('message', 'PRODUTO CADASTRADO COM SUCESSO!');
        }

        return redirect()->back()->with('error', 'ERRO AO CADASTRAR O PRODUTO.')->withInput();
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $data = $request->all();

        // formata a moeda
        $valueFormt = str_replace(',','.',str_replace('.','',$data['price'])); 

        $data['price'] = $valueFormt;

        $product = Product::find($id);

        $update = $product->update($data);

        if($update){
            return redirect()->route('home')->with('message', 'PRODUTO ATUALIZADO COM SUCESSO!');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        $delete = $product->delete();

        if($delete){
            return redirect()->route('home')->with('message', 'PRODUTO DELETADO COM SUCESSO!'); 
        }
        return redirect()->back()->with('error', 'ERRO AO TENTAR DELETAR PRODUTO.');
    }
}
