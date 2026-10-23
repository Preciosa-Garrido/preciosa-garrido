<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Image extends Model
{
	protected $fillable = array('product_id', 'image1', 'image2');

    public function product()
    {
    	return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function store($request)
    {
        $product = $request->all();

        if($request->hasFile('image1') && $request->file('image1')->isValid() || $request->hasFile('image2') && $request->file('image2')->isValid()):
            $nome = 'alt_img_'.time();

            $extensao = $request->image1->extension();

            $nomeArquivo = "{$nome}.{$extensao}";

            $request->image1->storeAs('public/product/'.Str::kebab($request->product), $nomeArquivo);


            $name = 'img_alt_'.time();

            $extension = $request->image2->extension();

            $archiveName = "{$name}.{$extension}";

            $request->image2->storeAs('public/product/'.Str::kebab($request->product), $archiveName);

            $product['image1'] = Str::kebab($request->product).'/'.$nomeArquivo;
            $product['image2'] = Str::kebab($request->product).'/'.$archiveName;
        endif;

        if($this->create($product))
            return true;
        else
            return false;
    }

    public function updateImage($request, $id)
    {
        $product = $request->all();
        $image = Image::whereProductId($id)->first();

        if($request->hasFile('image1') && $request->file('image1')->isValid() || $request->hasFile('image2') && $request->file('image2')->isValid()):
            $nome = 'alt_img_'.time();

            $extensao = $request->image1->extension();

            $nomeArquivo = "{$nome}.{$extensao}";

            $request->image1->storeAs('public/product/'.Str::kebab($request->product), $nomeArquivo);

            $name = 'img_alt_'.time();

            $extension = $request->image2->extension();

            $archiveName = "{$name}.{$extension}";

            $request->image2->storeAs('public/product/'.Str::kebab($request->product), $archiveName);

            $product['image1'] = Str::kebab($request->product).'/'.$nomeArquivo;
            $product['image2'] = Str::kebab($request->product).'/'.$archiveName;
        endif;

        if($image->fill($product)->update())
            return true;
        else
            return false;
    }
}
