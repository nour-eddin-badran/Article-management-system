<?php

namespace App\Http\Resources\Api;

use App\Modules\EnumManager\Enums\GeneralEnum;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

class PaginatedCollection extends ResourceCollection
{

    public function __construct($resource, $resourceClass)
    {
        $this->collects = $resourceClass;
        parent::__construct($resource);
    }

    /**
     * The resource that this resource collects.
     *
     * @var string
     */
    public $collects;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'items' => $this->collection,
            'pagination' => $this->paginationInfo ?? [
                    'total' => $this->total(),
                    'count' => $this->count(),
                    'per_page' => $this->perPage(),
                    'current_page' => $this->currentPage(),
                    'total_pages' => $this->lastPage()
                ],
        ];
    }

    public function with($request)
    {
        return [
            'metaData' => [
                'status' => Response::HTTP_OK,
                'message' => null,
                'key' => GeneralEnum::SUCCESS,
                'error_id' => null
            ],
        ];
    }
}
