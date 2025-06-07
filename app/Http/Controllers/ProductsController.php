<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function createProduct(Request $req){
        if ($req->productName && $req->productDesc && $req->productPrice && $req->productImage){
            $filename = time() . $req->productImage->getClientOriginalName();
            $move = $req->productImage->move(public_path('uploads/product_images'), $filename);
            if ($move) {
                $product = new Product;
                $product->name = $req->productName;
                $product->description = $req->productDesc;
                $product->price = $req->productPrice;
                $product->image = $filename;
                $product->user_id = $req->userId;
                $save = $product->save();
                if ($save) {
                    return redirect('/dashboard')->with('productmessage', 'New Product uploaded successfully');
                } else {
                    return 'not saved';
                }
            } else {
                return 'not moved';
            }
        } else if ($req->productName && $req->productPrice && $req->productImage){
            $filename = time() . $req->productImage->getClientOriginalName();
            $move = $req->productImage->move(public_path('uploads/product_images'), $filename);
            if ($move) {
                $product = new Product;
                $product->name = $req->productName;
                $product->price = $req->productPrice;
                $product->image = $filename;
                $product->user_id = $req->userId;
                $save = $product->save();
                if ($save) {
                    return redirect('/dashboard')->with('productmessage', 'New Product uploaded successfully');
                } else {
                    return 'not saved';
                }
            } else {
                return 'not moved';
            }
        } else if ($req->productName && $req->productDesc && $req->productPrice){
                $product = new Product;
                $product->name = $req->productName;
                $product->description = $req->productDesc;
                $product->price = $req->productPrice;
                $product->user_id = $req->userId;
                $save = $product->save();
                if ($save) {
                    return redirect('/dashboard')->with('productmessage', 'New Product uploaded successfully');
                } else {
                    return 'not saved';
                }
        } else if ($req->productName && $req->productPrice){
                $product = new Product;
                $product->name = $req->productName;
                $product->price = $req->productPrice;
                $product->user_id = $req->userId;
                $save = $product->save();
                if ($save) {
                    return redirect('/dashboard')->with('productmessage', 'New Product uploaded successfully');
                } else {
                    return 'not saved';
                }
        } else {
            return 'Please enter both a product name and price.';
        }
    }

    public function viewMyProduct($id){
        $products = User::find($id)->Product()->get();
        return view('displayproducts')->with('myproducts', $products);
    }

    public function allProducts(){
        $allproducts = Product::with('User')->get();
        return view('shop')->with('allproducts', $allproducts);
    }
}
