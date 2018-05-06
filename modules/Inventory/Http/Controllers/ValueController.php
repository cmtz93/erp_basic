<?php

namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Concerns\Crudable;
use Modules\Inventory\Models\Value;

class ValueController extends Controller
{
    use Crudable;

    private $rules = [
        'value'         => 'required|string|max:255',
        'status'        => 'required|boolean',
        'attribute_id'  => 'required|exists:inv_attributes,id',
    ];

    private $attribute = 'value';
    private $Model = Value::class;
    private $attributes = ['id', 'value', 'status', 'attribute_id'];
    private $filters = ['filter.value', 'filter.status', 'filter.attribute'];
    private $response = array ('actions' => ['show' , 'edit', 'destroy']);

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $builder = $this->Model::select($this->attributes)->with('attribute:id,name');
        if ($request->has('filter')) $builder->filter($request->only($this->filters));
        if ($request->has('all')) $this->response['data'] = $builder->get();
        else $this->response = array_merge(
                $this->response, 
                $builder->paginate($request->get('perPage'))->toArray() 
            );
        return $this->list();
    }
}
