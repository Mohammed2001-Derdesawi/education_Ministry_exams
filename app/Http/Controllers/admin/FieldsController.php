<?php

namespace App\Http\Controllers\admin;

use App\Models\Field;
use App\Models\Fields;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\field\FieldRequest;

class FieldsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fields=Field::select('id','name')->search(request()->search)->where('specialization_id',getAuthspecialization("id"))->paginate(10);
        return view('admin.fields.index',['fields'=>$fields]);

    }

    public function show($id)
    {
        $field=Field::with('norms.standards:standard,mark')->findOrFail($id);
        return view('admin.fields.show',['field'=>$field]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FieldRequest $request)
    {
         $filed=Field::create([
            'name'=>$request->name,
            'specialization_id'=>getAuthspecialization("id")
         ]);

         return redirect()->route('admin.fields.index')->with('success','تم إضافة المجال بنجاح');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Fields  $fields
     * @return \Illuminate\Http\Response
     */
    public function update(FieldRequest $request, Field $field)
    {
       $field->update([
           'name'=>$request->name
       ]);

       return redirect()->route('admin.fields.index')->with('success','تم تعديل المجال بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Fields  $fields
     * @return \Illuminate\Http\Response
     */
    public function destroy(Field $field)
    {
        $field->delete();
        return redirect()->route('admin.fields.index')->with('success','تم حذف المجال بنجاح');

    }
}
