<?php
namespace Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Inventory\Models\Manufacturer;
use App\Http\Concerns\Crudable;

class ManufacturerController extends Controller
{
    use Crudable;

    private $rules = [
        'name'      => 'required|string|max:255',
        'status'    => 'required|boolean',
        'quality'   =>'required|integer|min:1|max:5',
        'description' => 'nullable|string',
        'cover'     => 'nullable|image',
    ];

    private $attribute = 'manufacturer';
    private $Model = Manufacturer::class;
    private $attributes = ['id', 'name', 'description', 'cover', 'quality', 'status'];
    private $filters = ['filter.name','filter.quality', 'filter.status'];
    private $response = array ('actions' => ['show' , 'edit', 'destroy']);

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $builder = $this->Model::select($this->attributes);
        if ($request->has('filter')) $builder->filter($request->only($this->filters));
        if ($request->has('all')) $this->response['data'] = $builder->get();
        else $this->response = array_merge(
                $this->response, 
                $builder->paginate($request->get('perPage'))->toArray() 
            );
        return $this->list();
    }

}
