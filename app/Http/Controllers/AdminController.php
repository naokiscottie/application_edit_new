<?php

namespace App\Http\Controllers;

use App\Models\AdminUsers;
use App\Models\Field;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Inspection_month_checking;
use App\Models\Inspection_panel_checking;
use App\Models\Inspection_panel_measurement;
use App\Models\Inspection_year_checking;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){

        $session_value = Session::get('email');
        $record = AdminUsers::where('email',$session_value)->get()->first();

        $test = 10;
        $lists = DB::table('companys')->join('fields','fields.customer_id','=','companys.id')->where('fields.customer_id',$record->customer_id)->get();
        return view('customer_view')->with([
            'session_value' => $session_value,
            'test' => $test,
            'lists' => $lists,

        ]);
    }

    public function Customer_list1($id){


        $field = Field::find($id);
        $name = $field->field_name;
        $year_checkings = Inspection_year_checking::where('field_id',$id)->get();
        $panel_checkings = Inspection_panel_checking::where('field_id',$id)->get();

        $panel_measurements = Inspection_panel_measurement::where('field_id',$id)->get();
        $month_checkings = Inspection_month_checking::where('field_id',$id)->get();


        return view('customer_list_first',['month_checkings' => $month_checkings],['year_checkings' => $year_checkings])->with([
            "name" => $name,
            "id" => $id,
            "panel_checkings" => $panel_checkings,
            "panel_measurements" => $panel_measurements,

        ]);

    }

    public function Customer_facility_list($id){

        $test = DB::table('event_lists')->join('events','event_lists.id','=','events.event_id')->join('fields','events.field_id','=','fields.id')->where('field_id',$id)->get();
        $event_lists = DB::table('event_lists')->join('events','event_lists.id','=','events.event_id')->where('field_id',$id)->get();
        //0419追加
        $event_lists = $event_lists->reverse();

        return view('customer_event_list',['event_lists' => $event_lists]);

    }

    public function Customer_event_list_explanation($id){
        $events = DB::table('event_lists')->join('events','events.event_id','=','event_lists.id')->where('events.id',$id)->get();
        return view('customer_event_remarks',['events' => $events]);
    }

    public function Customer_page1(Request $request){
        $inputs = $request -> all();
        dd($inputs['test_value']);
    }
}
