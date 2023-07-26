<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\panel\ManufacturerHelper;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;
use App\Http\Requests\StatusUpdateManufacturerRequest;
use App\Models\Manufacturer;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    protected $helper;
    public function __construct(ManufacturerHelper $helper)
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
            'title' => __('Manufacturers'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Products'), __('Manufacturers')],
                ['dashboard.index', 'products.panel', 'manufacturers.panel']
            ],
        ];

        return view('panel.manufacturer', compact('pageinfo'));
    }

    public function indexJson()
    {

        $manufacturer = $this->helper->getAll();

        return response()->json(['type' => 'success', 'code' => 200, 'message' => '', 'data' => $manufacturer]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreManufacturerRequest $request)
    {
        $validation = $request->validated();
        $this->helper->store($validation);
        if ($validation['ajax'])
            return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
        else
            return redirect()->route('manufacturers.panel')->with('success', __('The action was executed successfully.'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manufacturer $manufacturer)
    {
        return response()->json(['type' => 'success', 'code' => 200, 'message' => '', 'data' => $manufacturer]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $validation = $request->validated();
        $this->helper->update($manufacturer,$validation);
        if ($validation['ajax'])
            return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
        else
            return redirect()->route('manufacturers.panel')->with('success', __('The action was executed successfully.'));
    }
    public function statusupdate(StatusUpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $validation = $request->validated();
        $manufacturer->update($validation);
        if ($validation['ajax'])
            return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
        else
            return redirect()->route('manufacturers.panel')->with('success', __('The action was executed successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();
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
