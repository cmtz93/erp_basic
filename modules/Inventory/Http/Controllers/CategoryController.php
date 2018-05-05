<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Inventory\Models\Category;

class CategoryController extends Controller
{
    use \App\Http\Concerns\Crudable;

    private $rules = [
        'name'          => 'required|string|max:255',
        'status'        => 'required|boolean',
        'description'   => 'nullable|string',
        'cover'         => 'nullable|image',
        'icon'          => 'nullable|string|max:255',
        'category_id'   => 'nullable|exists:inv_categories,id',
    ];

    private $attribute = 'category';
    private $Model = Category::class;
    private $attributes = ['id', 'name', 'description', 'cover', 'icon', 'status', 'category_id'];
    private $filters = ['filter.name','filter.category', 'filter.status'];
    private $response = array('actions' => ['show' , 'edit', 'destroy']);

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $builder = $this->Model::select($this->attributes);
        if ($request->has('filter')) $builder->filter($request->only($this->filters));
        if ($request->has('mains')) $builder->whereNull('category_id');
        if ($request->has('subs')) $builder->whereNotNull('category_id');
        if ($request->has('childs')) $builder->with('childs:id,name,category_id');
        if ($request->has('parent')) $builder->with('parent:id,name');
        if ($request->has('all')) $this->response['data'] = $builder->get();
        else $this->response = array_merge(
            $this->response, 
            $builder->paginate($request->get('perPage'))->toArray() 
            );
        return $this->list();
    }    

}
