<?php

namespace App\Http\Controllers\Admin;

use App\CustomAnalyticsInfo;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomAnalyticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 15;
        $customAnalyticsInfos=collect();
        $customAnalyticsInfosDistinct=collect();

//        if (!empty($keyword)) {
//            $users = User::where('name', 'LIKE', "%$keyword%")->orWhere('email', 'LIKE', "%$keyword%")
//                ->latest()->paginate($perPage);
//        } else {
//            $users = User::latest()->paginate($perPage);
//        }
//        if (!empty($keyword)) {
//            $customAnalyticsInfos = CustomAnalyticsInfo::where('analytics_type', 'LIKE', "%$keyword%")
//                ->latest()->paginate($perPage);
//        } else {
//            $customAnalyticsInfos = CustomAnalyticsInfo::latest()->paginate($perPage);
//        }
        if (!empty($keyword)) {
            $customAnalyticsInfosDistinct = CustomAnalyticsInfo::select('analytics_type')->distinct()->where('analytics_type', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $customAnalyticsInfosDistinct = CustomAnalyticsInfo::select('analytics_type')->distinct()->latest()->paginate($perPage);
        }
//        $columns=User::first()->getTableColumns();
//        print_r($columns);
//        exit;
//        $caColumns=DB::getSchemaBuilder()->getColumnListing('custom_analytics_infos');
//        $caColumns=DB::connection()->getSchemaBuilder()->getColumnListing("custom_analytics_infos");
//        print_r($caColumns);
        $allCustomAnalytics = collect();
        $mergedCollection = $allCustomAnalytics->toBase()->merge($customAnalyticsInfos);
////        print_r($mergedCollection->toArray());
//        foreach ($mergedCollection as $caInfosItem){
//            if($caInfosItem->analytics_type=='link_click'){
//                echo 'aaaaaaaaaaaaa';
//            }
//            echo '<pre>';
//            echo $caInfosItem;
//            echo "</pre>";
//        }
//        exit;
//        $customAnalyticsInfos = CustomAnalyticsInfo::where('analytics_type', 'LIKE', "%$keyword%")->get();
//        $customAnalyticsInfosDistinct=CustomAnalyticsInfo::where('analytics_type', 'LIKE', "%$keyword%")->select('analytics_type')->distinct()->get();
        $customAnalyticsInfosDistinct->map(function ($item)
        {
            $item['count'] = count(CustomAnalyticsInfo::where('analytics_type',$item['analytics_type'])->get());
            return $item;
        });
//        , compact('customAnalyticsInfos'),
        return view('admin.custom.customanalytics.index',compact('customAnalyticsInfosDistinct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');

        return view('admin.custom.customanalytics.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|string|max:255|email|unique:users',
                'password' => 'required',
                'roles' => 'required'
            ]
        );

        $data = $request->except('password');
        $data['password'] = bcrypt($request->password);
        $user = User::create($data);

        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }

        return redirect('admin/users')->with('flash_message', 'User added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('admin.custom.customanalytics.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function edit($id)
    {
        $roles = Role::select('id', 'name', 'label')->get();
        $roles = $roles->pluck('label', 'name');

        $user = User::with('roles')->select('id', 'name', 'email')->findOrFail($id);
        $user_roles = [];
        foreach ($user->roles as $role) {
            $user_roles[] = $role->name;
        }

        return view('admin.custom.customanalytics.edit', compact('user', 'roles', 'user_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int      $id
     *
     * @return void
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|string|max:255|email|unique:users,email,' . $id,
                'roles' => 'required'
            ]
        );

        $data = $request->except('password');
        if ($request->has('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user = User::findOrFail($id);
        $user->update($data);

        $user->roles()->detach();
        foreach ($request->roles as $role) {
            $user->assignRole($role);
        }

        return redirect('admin/users')->with('flash_message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return void
     */
    public function destroy($id)
    {
        User::destroy($id);

        return redirect('admin/users')->with('flash_message', 'User deleted!');
    }
}

