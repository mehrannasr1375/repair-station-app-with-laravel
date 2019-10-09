<?php
namespace App\Http\Controllers;
use App\Order;
use App\Reminder;
use Illuminate\Http\Request;
use Khill\Lavacharts\Lavacharts;
use Lava;

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

        $reminders = Reminder::where('status_code', '>=', '0')->orderBy('id', 'desc')->paginate(5);
        $reminders_count = count(Reminder::all()->toArray());

        return view('dashboard.index', compact('reminders', 'reminders_count'));
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }



    /* Ajax Requests -------------------------------------------------------------------------------------------------------------------------*/
    public function search( Request $request )
    {
        $search_type = $request->search_type;
        $search_title = $request->search_title;

        if ( $search_type == 'order_id' )
            $order = Order::where('id', '=', (int)$search_title)->with('customer');

        if ( $order->first() ) {
            return response(json_encode($order->first()), 200);

        } else {
            return response('false', 200);

        }
    }

}
