<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $app;
    protected $fractal;

    /**
     * CategoryController constructor.
     *
     * @param Application $app
     * @param Request     $request
     */
    public function __construct(Application $app, Request $request)
    {
        $this->app     = $app;
        $this->fractal = $app->make('fractal');

        $this->parseIncludes($request);
    }

    /**
     * Transform an item.
     *
     * @param        $data
     * @param        $transformer
     * @param string $resourceKey
     *
     * @return mixed
     */
    public function item($data, $transformer, $resourceKey = 'data')
    {
        $item = new Item($data, $transformer, $resourceKey);

        return $this->fractal->createData($item)->toArray();
    }

    /**
     * Transform a collection.
     *
     * @param        $data
     * @param        $transformer
     * @param string $resourceKey
     *
     * @return array
     */
    public function collection($data, $transformer, $resourceKey = 'data')
    {
        $collection = new Collection($data, $transformer, $resourceKey);

        return $this->fractal->createData($collection)->toArray();
    }

    /**
     * @param Request $request
     */
    protected function parseIncludes(Request $request)
    {
        if (!empty($include = $request->get('include'))) {
            $this->fractal->parseIncludes($include);
        }
    }

    /**
     * @param       $data
     * @param int   $code
     * @param array $headers
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function jsonResponse($data, $code = 200, $headers = [])
    {
        return response()->json($data, $code, $headers);
    }
}
