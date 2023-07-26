<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\panel\TargetMarketHelper;
use App\Http\Requests\StatusUpdateTargetMarketRequest;
use App\Http\Requests\StoreTargetMarketRequest;
use App\Http\Requests\UpdateTargetMarketRequest;
use App\Models\TargetMarket;
use Illuminate\Http\Request;

class TargetMarketController extends Controller
{
    protected $helper;
    public function __construct(TargetMarketHelper $helper)
    {
        $this->middleware(['auth', 'CheckAdmin']);
        $this->helper = $helper;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageinfo = [
            'title' => __('Customer groups'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Customers'), __('Customer groups')],
                ['dashboard.index', 'customer.panel', 'customergroups.panel']
            ],
        ];

        return view('panel.targetmarket', compact('pageinfo'));
    }
    public function indexJson(Request $request)
    {

        $customergroup = $this->helper->getCustomerGroup();

        return response()->json(['type'=>'success','code'=>200,'message' => '','data'=>$customergroup]);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTargetMarketRequest $request)
    {
        $validation = $request->validated();
        $this->helper->store($validation);
        if ($validation['ajax'])
            return response()->json(['type'=>'success','code'=>200,'message' => 'success','data'=>[]]);
        else
            return redirect()->route('customergroups.panel')->with('success', __('The action was executed successfully.'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TargetMarket $targetmarket)
    {
        return response()->json(['type'=>'success','code'=>200,'message' => '','data'=>$targetmarket]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTargetMarketRequest $request, TargetMarket $targetmarket)
    {
        $validation = $request->validated();
        $this->helper->update( $targetmarket,$validation);
        if ($validation['ajax'])
            return response()->json(['type'=>'success','code'=>200,'message' => 'success','data'=>[]]);
        else
            return redirect()->route('customergroups.panel')->with('success', __('The action was executed successfully.'));

    }
    public function statusupdate(StatusUpdateTargetMarketRequest $request, TargetMarket $targetmarket)
    {
        $validation = $request->validated();
        $targetmarket->update($validation);
        if ($validation['ajax'])
            return response()->json(['type'=>'success','code'=>200,'message' => 'success','data'=>[]]);
        else
            return redirect()->route('customergroups.panel')->with('success', __('The action was executed successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TargetMarket $targetmarket)
    {
        $targetmarket->delete();
        return response()->json(['type'=>'success','code'=>200,'message' => 'success','data'=>[]]);
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->input('grpids');
        $this->helper->deleteAll($ids);
        return response()->json(['type'=>'success','code'=>200,'message' => 'success','data'=>[]]);
    }
}
