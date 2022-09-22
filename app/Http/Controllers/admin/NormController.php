<?php

namespace App\Http\Controllers\admin;

use App\Models\Norm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\norm\NormRequest;
use App\Models\Field;
use Illuminate\Support\Facades\Auth;

class NormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $norms=Norm::with('standards')->join("fields",'fields.id','=','norms.id')->where('fields.specialization_id',getAuthspecialization("id"))->search(request()->search)->paginate(15);

        return view('admin.norms.index',['norms'=>$norms]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields=Field::select('id','name')->where('specialization_id',Auth::guard('admin')->user()->specialization_id)->get();

        return view('admin.norms.create',['fields'=>$fields]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NormRequest $request)
    {
        $norm=Norm::create([
            'norm'=>$request->norm,
             'field_id'=>$request->field,

        ]);
        $standards=[];
        foreach($request->standards as $standard)
        {
            $standards[]=['standard'=> $standard['standard'],'mark'=>$standard["mark"]];

        }

        $norm->standards()->createMany($standards);

        return redirect()->route('admin.norms.index')->with('success','تم حفظ المعيار بنجاح');


    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Norm  $norm
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fields=Field::select('id','name')->where('specialization_id',Auth::guard('admin')->user()->specialization_id)->get();

        $norm=Norm::with('standards')->findOrFail($id);
        return view('admin.norms.edit',['norm'=>$norm,'fields'=>$fields]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Norm  $norm
     * @return \Illuminate\Http\Response
     */
    public function update(NormRequest $request, Norm $norm)
    {
        $norm->update([
            'norm'=>$request->norm,
            'field_id'=>$request->field

        ]);
        $norm->standards()->delete();
        $standards=[];
        foreach($request->standards as $standard)
        {
            $standards[]=[ 'standard'=> $standard['standard'],'mark'=>$standard["mark"]];

        }


        $norm->standards()->createMany($standards);

        return redirect()->route('admin.norms.index')->with('success','تم تعديل المعيار بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Norm  $norm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Norm $norm)
    {
        $norm->delete();
        return redirect()->route('admin.norms.index')->with('success','تم حذف المعيار بنجاح');


    }
}
