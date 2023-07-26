<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\panel\CustomerHelper;
use App\Http\Helpers\panel\TargetMarketHelper;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;

class CustomerController extends Controller
{
    protected $helper;
    public function __construct(CustomerHelper $helper)
    {
        $this->middleware(['auth', 'CheckAdmin']);
        $this->helper = $helper;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $pageinfo = [
            'title' => __('Customers'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Customers'), __('Customers')],
                ['dashboard.index', 'customer.panel', 'customer.panel']
            ],
        ];
        $hp = new TargetMarketHelper();
        $cgrp = $hp->getActiveCustomerGroup()->pluck('name','id');

        return view('panel.customer', compact('pageinfo','cgrp'));
    }

    public function indexJson()
    {
        $users = $this->helper->activeUsers();
        return response()->json(['type' => 'success', 'code' => 200, 'message' => '', 'data' => $users]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        switch ($request->Input('type')) {
            case 'real':
                try {
                    $this->helper->realSave($this->helper->realValidator($request));
                    return redirect()->route('customer.panel')->with('success', __('The action was executed successfully.'));
                } catch (ValidationException $e) {
                    return redirect()->route('customer.panel')->withErrors($e->errors())->withInput();
                } catch (Exception $e) {
                    return redirect()->route('customer.panel')->with('warning', __('An unexpected error occurred and we have notified our support team. Please try again later.'))->withInput();
                }
            case 'legal':

                try {
                    $this->helper->legalSave($this->helper->legalValidator($request));
                    return redirect()->route('customer.panel')->with('success', __('The action was executed successfully.'));
                } catch (ValidationException $e) {
                    return redirect()->route('customer.panel')->withErrors($e->errors())->withInput();
                } catch (Exception $e) {
                    ~~dd($e);
                    return redirect()->route('customer.panel')->with('warning', __('An unexpected error occurred and we have notified our support team. Please try again later.'))->withInput();
                }
            default:
                return redirect()->route('customer.panel')->with('warning', __('An unexpected error occurred and we have notified our support team. Please try again later.'))->withInput();
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $user['customergroup'] = $user->customergroups()->pluck('name','id')->toArray();
        return response()->json(['type' => 'success', 'code' => 200, 'message' => '', 'data' => $user]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
    }

    public function destroyAll(Request $request)
    {
        $ids = $request->input('customerids');
        $this->helper->deleteAll($ids);
        return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
    }
}
