<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Inventory\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        return Category::with('parent' /*, 'childs'*/)->paginate();
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->rules);
        $cat = Category::create($data);
        return response()->success('Created', $cat , 201);
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Category $category)
    {
        return response()->success('show', $category->load('parent','childs'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate($this->rules);
        $category->update($data);
        return response()->success('Updated', $category );
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Category $category)
    {
        return response()->success('Deleted', $category->delete(), 204);
    }

    private $rules = [
            'name'          => 'required|string|max:255',
            'description'   => 'nullable|string',
            'status'        => 'required|boolean',
            'cover'         => 'nullable',
            'icon'          => 'nullable',
            'category_id'   => 'nullable|exists:categories,id',
        ];
}
