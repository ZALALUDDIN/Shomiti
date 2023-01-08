<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Exception;
use Illuminate\Http\Request;


class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $member=Member::all();
        return view('member.index', compact('member'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('member.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $m= new Member();
            $m->name = $request->FullName;
            $m->phone = $request->PhoneNumber;
            $m->email = $request->EmailAddress;
            $m->date = $request->date;

            $m->save();
            return redirect(route('asd.index'));
            }
            catch (Exception $error) {
            //dd($error);
            return redirect()->back()->withInput();
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function show(Member $member)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $member=Member::findOrFail($id);
        return view('member.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $m=Member::find($id);
            $m->name = $request->FullName;
            $m->phone = $request->PhoneNumber;
            $m->email = $request->EmailAddress;
            $m->date = $request->date;

            $m->save();
            return redirect(route('asd.index'));
            }
            catch (Exception $error) {
            //dd($error);
            return redirect()->back()->withInput();
            }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Member::find($id)->delete();
        return redirect()->back();
    }
}
