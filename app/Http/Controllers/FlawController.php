<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Flaw;
use Auth;

class FlawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nigar_flaws = Flaw::where('user_id', 7)->get();
        $nigar_flaws_accepted = Flaw::where([
            ['user_id', '=', 7],
            ['accepted', '=', 1]])->get();
        $nigar_flaws_count = count($nigar_flaws);
        $nigar_flaws_accepted_count = count($nigar_flaws_accepted);
        
        $orkhan_flaws = Flaw::where('user_id', 5)->get();
        $orkhan_flaws_accepted = Flaw::where([
            ['user_id', '=', 5],
            ['accepted', '=', 1]])->get();
        $orkhan_flaws_count = count($orkhan_flaws);
        $orkhan_flaws_accepted_count = count($orkhan_flaws_accepted);
        
        $total_count = $nigar_flaws_accepted_count + $orkhan_flaws_accepted_count;
        
        $nigar_flaws_accepted_percent = ($total_count > 0)? round($nigar_flaws_accepted_count / $total_count * 100) : 0;
        $orkhan_flaws_accepted_percent = ($total_count > 0)? round($orkhan_flaws_accepted_count / $total_count * 100) : 0;
        
        return view('contest',
                ['nigar_flaws' => $nigar_flaws,
                 'nigar_flaws_count' => $nigar_flaws_accepted_count,
                 'nigar_flaws_percent' => $nigar_flaws_accepted_percent,
                 'orkhan_flaws' => $orkhan_flaws,   
                 'orkhan_flaws_count' => $orkhan_flaws_accepted_count,
                 'orkhan_flaws_percent' => $orkhan_flaws_accepted_percent]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('group_id', 10)->orderBy('name', 'asc')->get();
        return view('contest_create')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'user_id' => 'required|numeric',
            'name' => 'required|min:3|max:200',
        );
        $this->validate($request, $rules);
        
        $flaw = new Flaw;
        $flaw->user_id = $request->user_id;
        $flaw->name = $request->name;
        $flaw->description = $request->description;
        $flaw->save();
        
        return redirect('/contest');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $flaw = Flaw::findOrFail($id);
        $user = User::findOrFail($flaw->user_id);
        
        $data_array = array(
            'flaw' => $flaw,
            'user_name' => $user->name
        );
        
        return view('contest_edit', $data_array);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = array(
            'name' => 'required|min:3|max:200',
        );
        $this->validate($request, $rules);
        
        $flaw = Flaw::findOrFail($id);
        $flaw->name = $request->name;
        $flaw->description = $request->description;
        $flaw->accepted = ($request->acceptance == 'accepted');
        $flaw->declined = ($request->acceptance == 'declined');
        $flaw->comment = $request->comment;
        $flaw->save();
        
        return redirect('/contest');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function details()
    {
        
    }
}
