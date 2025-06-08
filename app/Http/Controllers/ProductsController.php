<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function createProduct(Request $req){
        if ($req->productName && $req->productDesc && $req->productPrice && $req->productQty &&$req->productCategory && $req->productImage){
            $filename = time() . $req->productImage->getClientOriginalName();
            $move = $req->productImage->move(public_path('uploads/product_images'), $filename);
            if ($move) {
                $product = new Product;
                $product->name = $req->productName;
                $product->description = $req->productDesc;
                $product->price = $req->productPrice;
                $product->quantity = $req->productQty;
                $product->category = $req->productCategory;
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
        } else if ($req->productName && $req->productPrice && $req->productQty &&$req->productCategory && $req->productImage){
            $filename = time() . $req->productImage->getClientOriginalName();
            $move = $req->productImage->move(public_path('uploads/product_images'), $filename);
            if ($move) {
                $product = new Product;
                $product->name = $req->productName;
                $product->price = $req->productPrice;
                $product->quantity = $req->productQty;
                $product->category = $req->productCategory;
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
        } else if ($req->productName && $req->productDesc && $req->productPrice && $req->productQty &&$req->productCategory){
                $product = new Product;
                $product->name = $req->productName;
                $product->description = $req->productDesc;
                $product->price = $req->productPrice;
                $product->quantity = $req->productQty;
                $product->category = $req->productCategory;
                $product->user_id = $req->userId;
                $save = $product->save();
                if ($save) {
                    return redirect('/dashboard')->with('productmessage', 'New Product uploaded successfully');
                } else {
                    return 'not saved';
                }
        } else if ($req->productName && $req->productPrice && $req->productQty &&$req->productCategory){
                $product = new Product;
                $product->name = $req->productName;
                $product->price = $req->productPrice;
                $product->quantity = $req->productQty;
                $product->category = $req->productCategory;
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
        // return $products;
        return view('displayproducts')->with('myproducts', $products)->with('id', $id);
    }

    public function allProducts(){
        $allproducts = Product::with('User')->get();
        return view('shop')->with('allproducts', $allproducts);
    }
}
