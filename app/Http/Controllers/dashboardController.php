<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use Lava;
use Verta;

class dashboardController extends Controller
{

    public function index()
    {
        //Verta::setStringformat('y/n/');
        //$current_date = Verta::now();
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

        return view('dashboard.index');
    }



    public function logout()
    {
        auth()->logout();
        return redirect('/');
    }



















}
