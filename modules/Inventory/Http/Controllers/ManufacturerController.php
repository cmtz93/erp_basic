<?php
namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Inventory\Models\Manufacturer;

class ManufacturerController extends Controller
{

    private $rules = [
        'name'  => 'required|string|max:255',
        'status'=> 'required|boolean',
        'quality'=>'required|integer|min:1|max:5',
        'description' => 'nullable|string',
        'cover' => 'nullable|image',
    ];

    private $attribute = 'manufacturer';
    private $Model = Manufacturer::class;
    private $attributes = ['id', 'name', 'description', 'cover', 'quality', 'status'];
    private $filters = ['filter.name','filter.quality', 'filter.status'];
    private $actions = ['show' , 'edit', 'destroy'];

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $builder = $this->Model::select($this->attributes);
        if ($request->has('filter')) $builder->filter($request->only($this->filters));
        if ($request->has('all')) $response['data'] = $builder->get();
        else $response = $builder->paginate($request->get('perPage'))->toArray();
        $response['actions'] = $this->actions;
        return response()
            ->success(
                __('message.list', ['attribute' => str_plural($this->attribute)]), 
                $response['data'],
                200,
                collect($response)->except('data')
            );
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {        
        $data = $this->validation($request, $this->rules);
        return response()
            ->success(
                __('message.created', ['attribute' => $this->attribute]), 
                $this->Model::create($data), 
                201
            );
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show(Manufacturer $manufacturer)
    {
        return response()
            ->success(
                __('message.show', ['attribute' => $this->attribute]), 
                $manufacturer
            );
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request, Manufacturer $manufacturer)
    {
        $data = $this->validation($request, $this->rules);
        return response()
            ->success(
                __('message.updated', ['attribute' => $this->attribute]), 
                tap($manufacturer)->update($data)
            );
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Manufacturer $manufacturer)
    {
        if ($manufacturer->delete()) {
            return response()
                ->success(
                    __('message.deleted', ['attribute' => $this->attribute])
                );
        } else {
            return response()->errors();
        }
    }

}
