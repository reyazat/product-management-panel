<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\panel\OptionHelper;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Models\Option;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    protected $helper;
    public function __construct(OptionHelper $helper)
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
            'title' => __('Options'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Products'), __('Options')],
                ['dashboard.index', 'products.panel', 'options.panel']
            ],
        ];

        return view('panel.option', compact('pageinfo'));
    }
    public function indexJson()
    {
        $options = $this->helper->getAll();

        return response()->json(['type' => 'success', 'code' => 200, 'message' => '', 'data' => $options]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pageinfo = [
            'title' => __('Options'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Products'), __('Options'), __('Add')],
                ['dashboard.index', 'products.panel', 'options.panel']
            ],
        ];


        return view('panel.addoption', compact('pageinfo'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOptionRequest $request)
    {
        $validation = $request->validated();
        $this->helper->store($validation);
        return redirect()->route('options.panel')->with('success', __('The action was executed successfully.'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Option $option)
    {
        $pageinfo = [
            'title' => __('Options'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Products'), __('Options'), __('Edit')],
                ['dashboard.index', 'products.panel', 'options.panel']
            ],
        ];


        return view('panel.editoption', compact('pageinfo','option'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOptionRequest $request, Option $option)
    {
        $validation = $request->validated();

        $this->helper->update( $option,$validation);
        return redirect()->route('options.panel')->with('success', __('The action was executed successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        try {
            $option->delete();
        } catch (QueryException $e) {
            return response()->json(['type' => 'error', 'code' => 2300, 'message' => 'error', 'data' => []]);
        }
        return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
    }
    public function destroyAll(Request $request)
    {
        $ids = $request->input('grpids');
        try {
            $this->helper->deleteAll($ids);
        } catch (QueryException $e) {
            return response()->json(['type' => 'error', 'code' => 2300, 'message' => 'error', 'data' => []]);
        }
        return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
    }
}
