<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserMembership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipHistoryController extends Controller
{
    public function index()
    {
        return view('admin.membership-history.list');
    }

    public function listAjax(Request $request)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = UserMembership::with('plan')->orderBy('id','desc')->count();
        $totalRecordswithFilter = UserMembership::with('plan')->orderBy('id','desc')->count();

        // Fetch records
        $records = UserMembership::query();
        $records->with('plan');
        $records->orWhereHas('plan', function($query) use ($searchValue){
            $query->where('plan_name', 'like', '%' . $searchValue . '%');
        });
        $records->orWhereHas('user', function($query) use ($searchValue){
            $query->where('name', 'like', '%' . $searchValue . '%');
        });
        $records->orWhereHas('user', function($query) use ($searchValue){
            $query->where('email', 'like', '%' . $searchValue . '%');
        });
        $coulmns = ['amount', 'created_at'];
        foreach($coulmns as $column){
            $records->orWhere($column, 'like', '%' . $searchValue . '%');
        }
        // how to relation data order by
        //  if ($columnName == 'patient_name') {
        //     $records->with(['user' => function($query) use ($columnSortOrder){
        //         $query->orderBy('name', $columnSortOrder);
        //     }]);
        //  }
        //  if ($columnName == 'patient_email') {
        //     $records->with(['user' => function($query) use ($columnSortOrder){
        //         $query->orderBy('email', $columnSortOrder);
        //     }]);
        //  }

        //  if ($columnName == 'membership_plan') {
        //     $records->with(['plan' => function($query) use ($columnSortOrder){
        //         $query->orderBy('plan_name', $columnSortOrder);
        //     }]);
        //  }

            if ($columnName == 'membership_start_date') {
                // order by date pattern 01-01-2021
                $records->orderBy('created_at', $columnSortOrder);
            }
            if ($columnName == 'plan_amount') {
                $records->orderBy('amount', $columnSortOrder);
            }
                                                                                                                                                                                                                  
        $records->skip($start);
        $records->take($rowperpage);

        $records = $records->orderBy('id','desc')->get();

        $data_arr = array();

        foreach($records as $record){
            $data_arr[] = array(
                "patient_name" => $record->user->name,
                "patient_email" => $record->user->email,
                "membership_plan" => $record->plan->plan_name,
                "membership_start_date" => $record->created_at->format('d-m-Y'),
                "plan_amount" => $record->amount,
                // "action" => '<a title="Delete Doctor"  data-route="'.route('membership-history.delete', $record->id).'" href="javascipt:void(0);" id="delete"><i class="fas fa-trash"></i></a>'
            );
        }                                                                                                                                                   
                                                                                                                                                    
        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );

        return response()->json($response); 
    }
}
