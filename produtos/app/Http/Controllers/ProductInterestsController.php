<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Product;
use App\ProductInterest;

class ProductInterestsController extends Controller
{
    public function index($product_id)
    {
        try {
            $product = Product::findOrFail($product_id);
            $interests = $product->interests()->get();
            return response()->json($interests, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'produto não encontrado'], 404);
        }
    }
    public function show($product_id, $id)
    {
        try {
            $interests = ProductInterest::findOrFail($id);
            return response()->json($interests, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'produto não encontrado'], 404);
        }
        
    }
    public function create(Request $request, $product_id)
    {
        $rules = [
            'product_id' => 'required|exists:products,id',
            'name' => 'required',
            'message' => 'required',
            'email' => 'required'
        ];
        
        $messages = [
            'name.required' => 'O atributo name é obrigatório',
            'message.required' => 'O atributo message é obrigatório',
            'email.required' => 'O atributo email é obrigatório',
            'product_id.required' => 'O atributo product_id é obrigatório',
            'product_id.exists' =>  'O atributo product_id deve conter um id de produto válido'
        ];
        
        $this->validate($request, $rules, $messages);

        $interest = new ProductInterest();
        $interest->name = $request->input('name');
        $interest->message = $request->input('message');
        $interest->email = $request->input('email');
        $interest->product_id = $request->input('product_id');

        $interest->save();

        return response()->json(['message' => 'Interesse cadastrado com sucesso'], 201);
    }
    public function update(Request $request, $product_id, $id)
    {
        $rules = [
            'product_id' => 'required|exists:products,id',
            'name' => 'required',
            'message' => 'required',
            'email' => 'required'
        ];
        
        $messages = [
            'name.required' => 'O atributo name é obrigatório',
            'message.required' => 'O atributo message é obrigatório',
            'email.required' => 'O atributo email é obrigatório',
            'product_id.required' => 'O atributo product_id é obrigatório',
            'product_id.exists' =>  'O atributo product_id deve conter um id de produto válido'
        ];
        $this->validate($request, $rules, $messages);
        try {
            

            $interest = ProductInterest::findOrFail($id);
            $interest->name = $request->input('name');
            $interest->message = $request->input('message');
            $interest->email = $request->input('email');
            $interest->product_id = $request->input('product_id');
            $interest->save();
    
            return response()->json(['message' => 'interesse atualizado com sucesso'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'interesse não encontrado'], 404);
        }
    }
    public function destroy($id)
    {
        try {
            $interest = ProductInterest::findOrFail($id);
            $interest->delete();
    
            return response()->json(['message' => 'interesse removido com sucesso'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'interesse não encontrado'], 404);
        }
    }
}
