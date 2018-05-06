<?php

namespace App\Http\Concerns;

trait Crudable
{
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
   * @param int $id
   * @return Response
   */
  public function show($id)
  {
    $object = $this->Model::findOrFail($id);
    return response()
      ->success(
        __('message.show', ['attribute' => $this->attribute]), 
        $object
      );
  }

  /**
   * Update the specified resource in storage.
   * @param  Request $request
   * @param int $id
   * @return Response
   */
  public function update(Request $request, $id)
  {
    $data = $this->validation($request, $this->rules);
    $object = $this->Model::findOrFail($id);
    return response()
      ->success(
        __('message.updated', ['attribute' => $this->attribute]), 
        tap($object)->update($data)
      );
  }

  /**
   * Remove the specified resource from storage.
   * @param int $id 
   * @return Response
   */
  public function destroy($id)
  {
    $object = $this->Model::findOrFail($id);
    if ($object->delete()) {
      return response()
        ->success(
          __('message.deleted', ['attribute' => $this->attribute])
        );
    } else {
      return response()->errors();
    }
  }

  /**
   *
   *
   * 
   */
  public function list()
  {
    if(\Request::has('all')) $this->response['total'] = count($this->response['data']);
    return response()
      ->success(
        __('message.list', ['attribute' => str_plural($this->attribute)]), 
        $this->response['data'],
        200,
        collect($this->response)->except('data')
      );
  }
}
