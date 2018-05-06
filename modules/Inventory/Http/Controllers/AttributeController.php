<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Concerns\Crudable;
use Modules\Inventory\Models\Attribute;

class AttributeController extends Controller
{
    use Crudable;

    private $rules = [
        'name'          => 'required|string|max:255',
        'value_type'    => 'required|string|max:255',
        'description'   => 'nullable|string',
        'status'        => 'required|boolean',
        'required'      => 'nullable|boolean',
        'category_id'   => 'nullable|exists:inv_categories,id',
    ];

    private $attribute = 'attribute';
    private $Model = Attribute::class;
    private $attributes = ['id', 'name', 'description', 'value_type', 'status', 'required', 'category_id'];
    private $filters = ['filter.name', 'filter.status', 'filter.category'];
    private $response = array ('actions' => ['show' , 'edit', 'destroy']);

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $builder = $this->Model::select($this->attributes)
            ->with(['category:id,name','values:id,value,attribute_id']);
        if ($request->has('filter')) $builder->filter($request->only($this->filters));
        if ($request->has('all')) $this->response['data'] = $builder->get();
        else $this->response = array_merge(
                $this->response, 
                $builder->paginate($request->get('perPage'))->toArray() 
            );
        return $this->list();
    }
}
