<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use CodeandoMexico\Sismomx\Core\Services\QueryService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class DataController extends Controller
{
    /**
     * @var QueryService
     */
    protected $queryService;

    /**
     * DataController constructor.
     * @param QueryService $queryService
     */
    public function __construct(QueryService $queryService)
    {
        $this->queryService = $queryService;
    }

    public function news(Request $request)
    {
        try {
            $requestParams = $request->input('filters');
            $requestParams = json_decode($requestParams, true);

            $result = $this->queryService->run($requestParams);

            return Response::json($result);
        } catch (Exception $e) {
            $msg = 'Algo ha ido mal';
            $result = [
                'msg' => $msg,
                'requestParams' => $requestParams
            ];

            return Response::json($result);
        }
    }
}
