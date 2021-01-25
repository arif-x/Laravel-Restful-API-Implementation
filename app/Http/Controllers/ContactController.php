<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contact;

class ContactController extends Controller
{
    public function index(){
    	$contact = Contact::all();
    	return response()->json($contact, 200);
    }

    public function show($id){
    	$contact = Contact::find($id);
    	return response()->json($contact, 200);
    }

    public function store(Request $request){
    	$contact = Contact::create($request->all());
    	return response()->json($contact, 201);
    }

    public function update(Request $request, $id){
    	$contact = Contact::findOrFail($id);
    	$contact->update($request->all());
    	return response()->json($contact, 200);
    }

    public function delete($id){
    	$contact = Contact::findOrFail($id);
    	$contact->delete();
    	return response()->json($contact, 204);
    }
}
