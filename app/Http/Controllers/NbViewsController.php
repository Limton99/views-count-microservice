<?php
namespace App\Http\Controllers;

use App\DataTransferObjects\ViewsIdentifierObject;
use App\DataTransferObjects\ViewsRequestData;
use App\Http\Requests\ViewRequest;
use App\Services\NbViewsService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;

/**
 * Контроллер отвечающий за работу с просмотрами
 */
class NbViewsController extends Controller
{
    protected $nbViewsService;

    /**
     * Конструктор для обявления NbViewsService()
     *
     * @param NbViewsService $nbViewsService
     */
    public function __construct(NbViewsService $nbViewsService)
    {
        $this->nbViewsService = $nbViewsService;
    }

    /**
     * Контроллер вызывающий метод incrementView() в NbViewsService()
     *
     * @param  ViewRequest                          $request
     * @param  string                               $projectId
     * @param  string                               $entityId
     * @param  string                               $objectId
     * @return Application|ResponseFactory|Response
     */
    public function increment(ViewRequest $request, $projectId, $entityId, $objectId)
    {
        $requestData     = ViewsRequestData::fromRequest($request);
        $viewIdentifiers = ViewsIdentifierObject::fromParams($projectId, $entityId, $objectId);

        return response($this->nbViewsService->incrementView($requestData, $viewIdentifiers));
    }

    /**
     * Контроллер вызывающий метод showCount() в NbViewsService()
     *
     * @param  ViewRequest                          $request
     * @param  string                               $projectId
     * @param  string                               $entityId
     * @param  string                               $objectId
     * @return Application|ResponseFactory|Response
     */
    public function show(ViewRequest $request, $projectId, $entityId, $objectId)
    {
        $requestData     = ViewsRequestData::fromRequest($request);
        $viewIdentifiers = ViewsIdentifierObject::fromParams($projectId, $entityId, $objectId);

        return response($this->nbViewsService->showCount($requestData, $viewIdentifiers));
    }

    /**
     * Контроллер вызывающий метод showCount() в NbViewsService()
     *
     * @param  ViewRequest                          $request
     * @param  string                               $projectId
     * @param  string                               $entityId
     * @param  string                               $objectId
     * @return Application|ResponseFactory|Response
     */
    public function showByDate(ViewRequest $request, $projectId, $entityId, $objectId)
    {
        $requestData     = ViewsRequestData::fromRequest($request);
        $viewIdentifiers = ViewsIdentifierObject::fromParams($projectId, $entityId, $objectId);

        return response($this->nbViewsService->showCountByDate($requestData, $viewIdentifiers));
    }
}
