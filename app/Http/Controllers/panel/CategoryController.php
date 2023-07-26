<?php

namespace App\Http\Controllers\panel;

use App\Http\Controllers\Controller;
use App\Http\Helpers\panel\CategoryHelper;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $helper;
    public function __construct(CategoryHelper $helper)
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
            'title' => __('Categories'),
            'description' => 'description',
            'keywords' => 'keywords',
            'owner' => 'owner',
            'breadcrumbs' => [
                ['Home', __('Products'), __('Categories')],
                ['dashboard.index', 'products.panel', 'categories.panel']
            ],
        ];

        return view('panel.category', compact('pageinfo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = $this->helper->getAll();

        return response()->json(['type' => 'success', 'code' => 200, 'message' => '', 'data' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $validation = $request->validated();
        $this->helper->store($validation);
        if ($validation['ajax'])
            return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
        else
            return redirect()->route('manufacturers.panel')->with('success', __('The action was executed successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $parents = $this->helper->getParents();
        return response()->json(['type' => 'success', 'code' => 200, 'message' => '', 'data' => $parents]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return response()->json(['type' => 'success', 'code' => 200, 'message' => '', 'data' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $validation = $request->validated();
        $this->helper->update($category, $validation);
        if ($validation['ajax'])
            return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
        else
            return redirect()->route('manufacturers.panel')->with('success', __('The action was executed successfully.'));
    }

    public function statusupdate(Request $request, Category $category)
    {
        $validation = $request->validate([
            'status' => 'required|integer',
            'ajax' => 'required|boolean',
        ]);
        $category->update($validation);
        if ($validation['ajax'])
            return response()->json(['type' => 'success', 'code' => 200, 'message' => 'success', 'data' => []]);
        else
            return redirect()->route('manufacturers.panel')->with('success', __('The action was executed successfully.'));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            $category->delete();
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
