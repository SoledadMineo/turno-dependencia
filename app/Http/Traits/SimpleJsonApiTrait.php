<?php
namespace App\Http\Traits;

use Illuminate\Http\Request;

trait SimpleJsonApiTrait
{

    /**

     *  Muestra un listado de los tipos de campos
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rows = isset($this->eager) ? $this->model::with($this->eager)->filter() : $this->model::filter();
        $itemsPorPagina = 100;
        if (isset($this->resource)) {
            return $this->resource::collection($rows->paginate($itemsPorPagina));
        }

        if ($rows->count() > $itemsPorPagina) {
            return $rows->paginate($itemsPorPagina);
        }
        return $rows->get();
    }

    /**
     * Muestra el elemento solicitado
     *
     * @param String $id id del elemento
     *
     * @return \Illuminate\Http\Response
     */
    public function show(String $id)
    {
        $row = $this->model::findOrFail($id);
        if (isset($this->eager)) {
            return $row->load($this->eager);
        }
        return $row;
    }

    /**
     * Crea un nuevo elemento
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $item = $this->model::create($data);
        if (isset($this->attach)) {
            foreach ($this->attach as $attach) {
                if (isset($data[$attach]) && method_exists($item, $attach)) {
                    $item->{$attach}()->attach($data[$attach]);
                }
            }
        }
        return $item;
    }

    /**
     * Borra un tipo de campo
     *
     * @param String $id Id del elemento a borrar
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(String $id)
    {
        $item = $this->model::findOrFail($id);
        if (isset($this->attach)) {
            foreach ($this->attach as $attach) {
                if (method_exists($item, $attach)) {
                    $item->{$attach}()->sync([]);
                }
            }
        }
        return $item->delete();
    }

    public function update(Request $request, String $id)
    {
        $item = $this->model::findOrFail($id);
        $data = $request->all();
        $item->update($data);
        if (isset($this->sync)) {
            foreach($this->sync as $sync) {
                $ids = [];
                if (isset($data[$sync])) {
                    foreach($data[$sync] as $subItem) {
                        if (is_array($subItem)) {
                            $ids[] = $subItem['id'];
                            continue;
                        }
                        $ids[] = $subItem;
                    }
                    $item->{$sync}()->sync($ids);
                }
            }
        }

        return $item;
    }
}
