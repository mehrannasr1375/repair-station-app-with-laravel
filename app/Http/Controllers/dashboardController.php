<?php
namespace App\Http\Controllers;
use App\Reminder;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use Lava;
use Verta;

class dashboardController extends Controller
{

    public function index()
    {
        $data = Lava::DataTable()
            ->addDateColumn('روز')
            ->addNumberColumn('سود خالص روزانه به تومان');
        for ($a = 1; $a <= 30; $a++) {
            $data->addRow(['2019/09/'.$a, rand(20000,800000)]);
        }
        Lava::AreaChart('Population', $data, [
            'title' => '',
            'legend' => ['position' => 'in']
        ]);

        $reminders = Reminder::where('status_code', '>', '1')->orderBy('id', 'desc')->paginate(5);

        return view('dashboard.index', compact('reminders'));
    }



    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }



















}
