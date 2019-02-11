<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use Image;
use File;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::All();
        return view('product.index', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'  => 'required', 
            'description'   => 'required',
            'color'   => 'required',
            'price'   => 'required',
            'file' => 'required',

        ]);


        $product = Product::create([
            'title'       => $request->title,
            'description' => $request->description,
            'color'       => $request->color,
            'price'       => $request->price,
            'file'        => $request->file,
        ]);
        

        $requestImage = $request->file;

        $filename = uniqid(rand(1,9999)) . '.' . $requestImage->getClientOriginalExtension();
        if (!is_dir(public_path() . '/img')) {
            mkdir(public_path() . '/img', 0777, true);
        }
        if (!is_dir(public_path() . '/img/product')) {
            mkdir(public_path() . '/img/product/', 0777, true);
        }
        if (!is_dir(public_path() . '/img/product/'.$product->id)) {
            mkdir(public_path() . '/img/product/'.$product->id, 0777, true);
        }
            
        $location = public_path('/img/product/'.$product->id.'/' . $filename);
        Image::make($requestImage)->save($location);
    
        
        $product->file = $filename;
        $product->save();


        return redirect('/product')->with('success', 'Data Added');
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
        $product = Product::find($id);

        return view('product.edit', compact('product', 'id'));
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
        $this->validate($request, [
            'title'  => 'required', 
            'description'   => 'required',
            'color'   => 'required',
            'price'   => 'required',
            'file' => 'required',
        ]);

        $product = Product::find($id);

        $product->title = $request->get('title');
        $product->description = $request->get('description');
        $product->color = $request->get('color');
        $product->price = $request->get('price');
        $product->file = $request->get('file');

        if ($request->has('file')) {
            File::delete('img/product/'.$product->id .'/'. $product->file );

            $requestImage = $request->file;
            $filename = uniqid(rand(1,9999)) . '.' . $requestImage->getClientOriginalExtension();
            if (!is_dir(public_path() . '/img')) {
                mkdir(public_path() . '/img', 0777, true);
            }
            if (!is_dir(public_path() . '/img/product')) {
                mkdir(public_path() . '/img/product/', 0777, true);
            }
            if (!is_dir(public_path() . '/img/product/'.$product->id)) {
                mkdir(public_path() . '/img/product/'.$product->id, 0777, true);
            }
                
            $location = public_path('/img/product/'.$product->id.'/' . $filename);
            Image::make($requestImage)->save($location);
                
            $product->file = $filename;
        }
        $product->save();
        return redirect()->route('product.index')->with('success', 'Data Updated');
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
        File::delete('img/product/'.$product->id .'/'. $product->file );
        File::delete('img/product/'.$product->id);

        $product->delete();
        return redirect()->route('product.index')->with('success', 'Data Deleted');
    }
}
