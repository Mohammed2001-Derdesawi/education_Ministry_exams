<?php

namespace App\Http\Controllers\user;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use App\Http\Requests\exam\ExamRequest;
use App\Http\Requests\user\UserLoginRequest;
use App\Models\Field;
use App\Models\Office;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function welcome()
    {
        $specializations=Specialization::select("id","specialization")->get();
        $offices=Office::select('id','name')->get();
        return view('user.welcome',['specializations'=>$specializations,'offices'=>$offices]);
    }

    public function getexam(UserLoginRequest $request)
    {
        session()->put('name',$request->name);
        session()->put('specialization',$request->specialization);
        session()->put("office",$request->office);
        $specialization=findById(['questions.norm.standards'],Specialization::class,['*'],$request->specialization);
        return view('user.exam',['questions'=>$specialization->questions,'specialization'=>$specialization->specialization]);
    }

    public function calculateMarks(ExamRequest $request)
    {
        if(!session()->get('name') ||  !session()->get('specialization') || !session()->get('office'))
        return redirect()->route('welcome')->with('warning','الرجاء تسجيل اسمك والتخصص أولا');
        $specialization_mark=DB::select(DB::raw('SELECT SUM(`standards`.`mark`) as all_mark FROM `standards` WHERE `standards`.`norm_id` in (SELECT `norms`.`id` FROM `norms` WHERE `norms`.`field_id` in (SELECT `fields`.`id` FROM `fields` WHERE `fields`.`specialization_id`='.session()->get('specialization').'))'));

        $user=User::create([
            'name'=>session()->get('name'),
            'specialization_id'=>session()->get('specialization'),
            'office_id'=>session()->get('office')
        ]);
        $marks=[];
        foreach($request->questions as $key=>$question)
        {

            foreach($question as $standard)
            {
                $marks[]=["question_id"=>$key,'standard_id'=>$standard];
            }
        }


         $user->marks()->createMany($marks);
        $user->loadSum('sum_marks as user_mark','mark');
        $user->load(['marks.standard.norm.field','specialization']);
        $user_mark=(int)(($user->user_mark/$specialization_mark[0]->all_mark)*100);
        $levelview='مستوى القيادة المنجزة';
        $level='achieved';
        if($user_mark >= 30 && $user->mark < 67)
        {
            $levelview='مستوى القيادة المتقنة';
            $level='mastered';
        }

        elseif($user->mark >=67)
        {
            $levelview='مستوى القيادة المؤثرة';
            $level='influential';

        }

        $user->update([
            'level'=>$level,
            'self_rating'=>$user_mark,
        ]);

        $fields=Field::withSum('standards as count_standards','mark')->where('specialization_id',session()->get("specialization"))->get();


        return view('user.exam-result',['fields'=>$fields,'marks'=>$user->marks,'user'=>$user,'user_mark'=>$user_mark,'level'=>$levelview,'questions'=> $specialization=findById(['questions.norm.standards'],Specialization::class,['*'],session()->get('specialization'))->questions]);

    }

}
