<?php

namespace App\Http\Controllers\admin;

use App\Models\User;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Models\Specialization;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\exam\ExamRequest;
use App\Http\Requests\user\ExportRequest;
use App\Http\Requests\user\Re_RatingRequest;

class AnalysisController extends Controller
{

    public function analysisSpecialization()
    {
        $specialization=Specialization::withCount(['users as count_users','achieved_users','influential_users','mastered_users'])->findOrFail(getAuthspecialization("id"));
       return view('admin.analysis.fields-results',['specialization'=>$specialization]);
    }

    public function userSpecializations()
    {

            $users=User::withSum('sum_marks as user_mark','mark')->where('specialization_id',getAuthspecialization("id"))->level(request()->level)->search(request()->search)->sort(request()->sort)->inoffice()->paginate(10);


        return view('admin.analysis.users-results',['users'=>$users]);
    }

    public function analysisUserMarks($id)
    {
        $user=User::with(['sum_marks.norm'])->where('specialization_id',getAuthspecialization("id"))->findOrFail($id);
        $marks=$user->sum_marks->groupBy('mark');
         return view('admin.analysis.marks-details',["marks"=>$marks,'user'=>$user]);


    }

    public function re_RatingPage($id)
    {
        $user=User::where('specialization_id',getAuthspecialization("id"))->inoffice()->findOrFail($id);

        $specialization=findById(['questions.norm.standards'],Specialization::class,['*'],getAuthspecialization("id"));
        return view('user.re-rating',['user'=>$user->id,'questions'=>$specialization->questions,"specialization"=>$specialization->specialization]);

    }
    public function re_RatingUser(Re_RatingRequest $request,$id)
    {

        $user=User::select("name","outer_rating","id")->findOrFail($id);
        $user_mark=0;

        foreach($request->questions as $mark)
        {
            $user_mark+=$mark;


        }
         $specialization_mark=DB::select(DB::raw('SELECT SUM(`standards`.`mark`) as all_mark FROM `standards` WHERE `standards`.`norm_id` in (SELECT `norms`.`id` FROM `norms` WHERE `norms`.`field_id` in (SELECT `fields`.`id` FROM `fields` WHERE `fields`.`specialization_id`='.getAuthspecialization('id').'))'));

        $user_mark=(int)(($user_mark/$specialization_mark[0]->all_mark)*100);

        $user->update([
            'outer_rating'=>$user_mark,
        ]);



        return redirect()->route('admin.result.users')->with('success',' تم تقييم '.$user->name." بنجاح");

    }

    public function exportUsers(ExportRequest $request)
    {
        return Excel::download(new UsersExport($request->from,$request->to),'المتقدمين.xlsx');

    }



}
