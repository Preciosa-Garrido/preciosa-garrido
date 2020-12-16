<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductPageController extends Controller
{
    public function __construct() {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.products.index', ['products' => Product::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.register', ['categories' => Category::orderBy('category')->get()]);
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
            'product' => ['required', 'string', 'unique:products'],
            'price' => ['required'],
            'stock' => ['required', 'int', 'min:5'],
            'barcode' => ['required', 'string'],
            'description' => ['required', 'string', 'max:255'],
            'category_id' => ['required'],
            'image' => ['required'],
            'image1' => ['required'],
            'image2' => ['required']
        ]);

        $requests = $request;
        $product = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()):
            $name = 'prin_img_'.time();

            $extensao = $request->image->extension();

            $nomeArquivo = "{$name}.{$extensao}";

            $product['image'] = kebab_case($request->product).'/'.$nomeArquivo;

            $request->image->storeAs('public/product/'.kebab_case($request->product), $nomeArquivo);
        endif;

        $store = Product::create($product);

        $requests['product_id'] = (new Product)->get()->last()->id;

        (new Image)->store($requests);

        if($store)
            return redirect()->back()->with('mensagem', 'Produto cadastrado com sucesso');

        return redirect()->back()->with('mensagem', 'Erro ao cadastrar produto');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.products.show', ['product' => Product::find($id)]);
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
        $categories = Category::orderBy('category')->get();

        return view('admin.products.edit', compact('product', 'categories'));
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
        $produto = Product::find($id);
        $requests = $request;
        $product = $request->all();

        if ($produto->product == $product['product']) {
            $this->validate($request, [
                'product' => ['required', 'string'],
                'price' => ['required'],
                'stock' => ['required'],
                'barcode' => ['required', 'string'],
                'description' => ['required', 'string', 'max:255'],
                'category_id' => ['required'],
                'image' => ['required']
            ]);
        } else {
            $this->validate($request, [
                'product' => ['required', 'string', 'unique:products'],
                'price' => ['required'],
                'stock' => ['required'],
                'barcode' => ['required', 'string'],
                'description' => ['required', 'string', 'max:255'],
                'category_id' => ['required'],
                'image' => ['required']
            ]);
        }


        if($request->hasFile('image') && $request->file('image')->isValid()):
            $name = 'prin_img_'.time();

            $extensao = $request->image->extension();

            $nomeArquivo = "{$name}.{$extensao}";


            $product['image'] = kebab_case($request->product).'/'.$nomeArquivo;

            $request->image->storeAs('public/product/'.kebab_case($request->product), $nomeArquivo);
        endif;

        $update = $produto->fill($product)->update();

        $requests['product_id'] = (new Product)->get()->last()->id;

        (new Image)->updateImage($requests, $id);

        if($update)
            return redirect()->back()->with('mensagem', 'Produto actualizado com sucesso');

        return redirect()->back()->with('mensagem', 'Erro ao actualizar produto');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Product::destroy($id))
            return redirect()->route('admin.products.consultar')->with('mensagem', 'Produto removido com sucesso');

        return redirect()->back()->with('mensagem', 'Erro ao remover produto');
    }

    public function specifications($id)
    {
        return view('admin.products.specifications', ['product' => Product::find($id)]);
    }
}
