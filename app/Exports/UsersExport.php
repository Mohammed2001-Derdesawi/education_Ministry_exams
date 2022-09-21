<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class UsersExport implements FromView
{
    public function __construct($from,$to)
    {
        $this->from = $from;
        $this->to=$to;
    }

    public function view(): View
    {
        return view('exports.users', [
            'users' =>  User::query()->withSum('sum_marks as user_mark','mark')->whereBetween('created_at', [$this->from,$this->to])->get()
        ]);
    }
}
