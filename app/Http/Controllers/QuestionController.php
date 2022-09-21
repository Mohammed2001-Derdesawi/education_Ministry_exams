<?php

namespace App\Http\Controllers;

use App\Models\Norm;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\question\QuestionRequest;

class QuestionController extends Controller
{
    protected $path='images/questions/';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spec=Specialization::with('norms')->findOrFail(getAuthspecialization("id"));
        $norms=$spec->norms;

        $questions=Question::with(['norm'=>function ($q){
            return $q->with(['field','standards']);
        }])->where('specialization_id',Auth::guard('admin')->user()->specialization_id)->search(request()->search)->paginate(15);


        return view('admin.questions.index',['questions'=>$questions,'norms'=>$norms]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $question=Question::create([
            'norm_id'=>$request->norm,
            'question'=>$request->question,
            'specialization_id'=>Auth::guard('admin')->user()->specialization_id,

        ]);
        if($request->hasFile('photo'))
        {
            $question->photo='storage/'.$this->path.storeImage($this->path,$request->photo);
            $question->save();

        }

        return redirect()->route('admin.questions.index')->with('success','تم إضافة السؤال بنجاح');

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionRequest $request, Question $question)
    {

           $question->norm_id=$request->norm;
            $question->question=$request->question;
        if($request->hasFile('photo'))
        {
            $question->photo='storage/'.$this->path.editImage($this->path,$request->photo,$question->photo);
        }

        $question->save();
        return redirect()->route('admin.questions.index')->with('success','لقد تم تعديل السؤال بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        if($question->photo)
        deleteImage($question->photo);

        $question->delete();
        return redirect()->route('admin.questions.index')->with('success','لقد تم حذف السؤال بنجاح');

    }
}
