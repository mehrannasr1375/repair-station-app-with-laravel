<?php
namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\newUserFormRequest;

class SignupController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('store', 'create');
    }


    public function create()
    {
        return view('auth.signup');
    }


    public function store(newUserFormRequest $request)
    {
        $data = $request->validated();

        \App\User::create($data);

        return redirect('/login');
    }

}
