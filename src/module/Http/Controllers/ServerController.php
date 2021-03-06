<?php
namespace Girolando\Componentes\Cruzamento\Http\Controllers;

use Andersonef\Repositories\Abstracts\ServiceAbstract;
use Girolando\BaseComponent\Contracts\ComponentServiceContract;
use Girolando\Componentes\Cruzamento\Services\Server\DatabaseEntityService;
use Girolando\Componentes\Cruzamento\Entities\Views\DatabaseEntity;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ServerController extends Controller
{
    private $service;

    /**
     * constructor.
     * @param $service
     */
    public function __construct(DatabaseEntityService $service)
    {
        $this->service = $service;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->service->getJsonDataset('_dataTableQuery'.$request->get('name'));
    }


    public function findBy(Request $request)
    {
        $fillable = (new DatabaseEntity())->getFillable();
        $requestFields = $request->all();

        return $this->service->findBy(
            collect($requestFields)
            ->only($fillable)
            ->toArray()
        )
        ->get();
    }

}
