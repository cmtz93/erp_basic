<?php
namespace Modules\Inventory\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Concerns\Crudable;
use Modules\Inventory\Models\Product;

class ProductController extends Controller
{
    use Crudable;

    private $rules = [
        'name'          => 'required|string|max:255',
        'barcode'       => 'nullable|string|max:255',
        'sku'           => 'nullable|string|max:255',
        'status'        => 'required|boolean',
        'description'   => 'nullable|string',
        'cover'         => 'required|image',
        'category_id'   => 'required|exists:inv_categories,id',
        'manuacturer_id'=> 'required|exists:inv_manufacturers,id',
        'status_id'     => 'required|exists:inv_statuses,id',
    ];

    private $attribute = 'product';
    private $Model = Product::class;
    private $attributes = [
        'id',
        'name',
        'sku',
        'barcode',
        'description',
        'cover',
        'status_id',
        'category_id',
        'manufacturer_id'
    ];
    private $filters = ['filter.name','filter.sku', 'filter.barcode', 'filter.statusId', 'filter.category', 'filter.manufaturer'];
    private $response = array ('actions' => ['show' , 'edit', 'destroy']);

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request)
    {
        $builder = $this->Model::select($this->attributes)
            ->with([
                'category:id,name',
                'status:id,name',
                'manufacturer:id,name',
            ]);
        if ($request->has('filter')) $builder->filter($request->only($this->filters));
        if ($request->has('all')) $this->response['data'] = $builder->get();
        else $this->response = array_merge(
                $this->response, 
                $builder->paginate($request->get('perPage'))->toArray() 
            );
        return $this->list();
    }
}