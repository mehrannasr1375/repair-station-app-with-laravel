<?php
namespace App\Http\Controllers;
use App\Order;
use Illuminate\Http\Request;
use App\Reminder;
use Verta;
use function Sodium\compare;

class RemindersController extends Controller
{

    public function create()
    {
        Verta::setStringformat('j / n / y H:i');

        return view('reminder.create');
    }

    public function store(Request $request)
    {
        Reminder::create($request->toArray());

        return redirect('/dashboard');
    }

    public function destroy(Request $request)
    {
        Reminder::where('id', '=', $request->id)->delete();

        return response('true', 200);
    }






}
