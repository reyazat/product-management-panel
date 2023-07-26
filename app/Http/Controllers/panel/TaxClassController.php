<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\panel\TaxClassHelper;
use App\Http\Requests\StoreTaxClassRequest;
use App\Http\Requests\UpdateTaxClassRequest;
use App\Models\TaxClass;
use Illuminate\Http\Request;

class TaxClassController extends Controller
{
    protected $helper;
    public function __construct(TaxClassHelper $helper)
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
            'title' => __('Value added tax'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Products'), __('Value added tax')],
                ['dashboard.index', 'products.panel', 'taxclasses.panel']
            ],
        ];

        return view('panel.taxclass', compact('pageinfo'));
    }

    public function indexJson()
    {

        $taxclass = $this->helper->getAll();

        return response()->json(['type' => 'success', 'code' => 200, 'message' => '', 'data' => $taxclass]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaxClassRequest $request)
    {
        $validation = $request->validated();
        $this->helper->store($validation);
        if ($validation['ajax'])
            return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
        else
            return redirect()->route('taxclasses.panel')->with('success', __('The action was executed successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(TaxClass $taxclass)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaxClass $taxclass)
    {
        return response()->json(['type' => 'success', 'code' => 200, 'message' => '', 'data' => $taxclass]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaxClassRequest $request, TaxClass $taxclass)
    {
        $validation = $request->validated();
        $this->helper->update($taxclass,$validation);
        if ($validation['ajax'])
            return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
        else
            return redirect()->route('taxclasses.panel')->with('success', __('The action was executed successfully.'));
    }

    public function statusupdate(Request $request, TaxClass $taxclass)
    {
        $validation = $request->validate([
            'status' => 'required|integer',
            'ajax' => 'required|boolean',
        ]);
        $taxclass->update($validation);
        if ($validation['ajax'])
            return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
        else
            return redirect()->route('taxclasses.panel')->with('success', __('The action was executed successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaxClass $taxclass)
    {
        $taxclass->delete();
        return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
    }
    /**
     * Delete All resource from storage
     *
     * @param Request $request
     */
    public function destroyAll(Request $request)
    {
        $ids = $request->input('grpids');
        $this->helper->deleteAll($ids);
        return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
    }
}
