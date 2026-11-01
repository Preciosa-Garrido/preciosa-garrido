<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image, $id)
    {
        return view('admin.products.update-images', ['product' => Product::find($id), 'images' => Image::whereProductId($id)->first()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $images = $request->all();

        if($request->hasFile('image1') && $request->file('image1')->isValid() || $request->hasFile('image2') && $request->file('image2')->isValid()):
            $nome = 'alt_img_'.time();

            $extensao = $request->image1->extension();

            $nomeArquivo = "{$nome}.{$extensao}";

            $request->image1->storeAs('public/product/'.Str::kebab($product->product), $nomeArquivo);


            $name = 'img_alt_'.time();

            $extension = $request->image2->extension();

            $archiveName = "{$name}.{$extension}";

            $request->image2->storeAs('public/product/'.Str::kebab($product->product), $archiveName);

            $images['image1'] = Str::kebab($product->product).'/'.$nomeArquivo;
            $images['image2'] = Str::kebab($product->product).'/'.$archiveName;
        endif;

        if($product->fill($images)->update())
            return redirect()->back()->with('message', 'Sucesso ao actualizar fotos');
        else
            return redirect()->back()->with('message', 'Erro ao actualizar fotos');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
