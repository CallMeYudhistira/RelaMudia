<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\MultimediaItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $carts = Cart::where('user_id', $user->id)->get();

        return view('pages.carts', compact('carts'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'multimedia_item_id' => 'required|numeric',
            'quantity' => 'required|int|min:1',
        ]);

        $item = MultimediaItem::find($data['multimedia_item_id']);
        $data['price'] = $item->price;
        $data['subtotal'] = $data['price'] * $data['quantity'];
        $data['user_id'] = $user->id;

        $existedCart = Cart::where('user_id', $data['user_id'])->where('multimedia_item_id', $data['multimedia_item_id'])->first();
        if ($existedCart) {
            $existedCart->update($data);
        }

        Cart::create($data);

        return redirect()->back()->with('success', 'Menambahkan ke keranjang.');
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        $data = $request->validate([
            'quantity' => 'required|int|min:1',
        ]);

        $cart = Cart::find($id);
        $cart->quantity = $data['quantity'];
        $cart->subtotal = $cart->price * $cart->quantity;
        $cart->save();

        return redirect()->back();
    }

    public function delete($id){
        Cart::destroy($id);
        
        return redirect()->back();
    }
}
