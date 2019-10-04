<?php
namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;
use App\Reminder;
use Verta;
use function Sodium\compare;

class RemindersController extends Controller
{

    public function store(Request $request)
    {
        $data = [
            'title'        =>  $request->title,
            'start_date'   =>  $request->start_date,
            'end_date'     =>  $request->end_date,
            'description'  =>  $request->description
        ];

        Reminder::create($data);

        return 'true';
    }

    public function destroy(Request $request)
    {
        Reminder::where('id', '=', $request->id)->delete();

        return response('true', 200);
    }

}
