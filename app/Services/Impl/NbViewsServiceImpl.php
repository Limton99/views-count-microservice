<?php
namespace App\Services\Impl;

use App\DataTransferObjects\ViewsIdentifierObject;
use App\DataTransferObjects\ViewsRequestData;
use App\Models\NbViews;
use App\Services\NbViewsService;
use Carbon\Carbon;

/**
 * Имплементация сервиса для работы с просмотрами
 */
class NbViewsServiceImpl implements NbViewsService
{
    /**
     * Метод для увеоичения количества просмотров
     *
     * @param ViewsRequestData      $request
     * @param ViewsIdentifierObject $identifierObject
     *
     * @return array[]
     */
    public function incrementView(ViewsRequestData $request, ViewsIdentifierObject $identifierObject)
    {
        $currentDate = Carbon::now()->toDateString();

        if ('bulk' != $identifierObject->getObjectId()) {
            $view = NbViews::where('projectId', '=', $identifierObject->getProjectId())
                ->where('entityId', '=', $identifierObject->getEntityId())
                ->where('objectId', '=', $identifierObject->getObjectId())
                ->where('date', '=', $currentDate)
                ->first();

            if ($view) {
                $view->nb_views        += $request->getNbViews();
                $view->nb_phone_views  += $request->getNbPhoneViews();
                $view->return_counters += $request->getReturnCounters();
                $view->save();

                return [
                    'data' => [
                        'nb_views'       => $view->nb_views,
                        'nb_phone_views' => $view->nb_phone_views,
                    ],
                ];
            }

            $view = new NbViews();

            $view->projectId = $identifierObject->getProjectId();
            $view->entityId  = $identifierObject->getEntityId();
            $view->objectId  = $identifierObject->getObjectId();
            $view->nb_views        += $request->getNbViews();
            $view->nb_phone_views  += $request->getNbPhoneViews();
            $view->return_counters += $request->getReturnCounters();
            $view->date = $currentDate;

            $view->save();

            return [
                'data' => [
                    'nb_views'       => $view->nb_views,
                    'nb_phone_views' => $view->nb_phone_views,
                ],
            ];
        }

        //Добавление просмотров пачкой
        $bulk  = $request->getBulk();
        $views = [];

        foreach ($bulk as $key => $value) {
            $view = NbViews::where('projectId', '=', $identifierObject->getProjectId())
                ->where('entityId', '=', $identifierObject->getEntityId())
                ->where('objectId', '=', $key)
                ->where('date', '=', $currentDate)
                ->first();

            if ($view) {
                $view->nb_views        += $bulk[$key]['nb_views'];
                $view->nb_phone_views  += $bulk[$key]['nb_phone_views'];
                $view->return_counters += $bulk[$key]['return_counters'];
                $view->save();
            } else {
                $view = new NbViews();

                $view->projectId = $identifierObject->getProjectId();
                $view->entityId  = $identifierObject->getEntityId();
                $view->objectId  = $key;
                $view->nb_views        += $bulk[$key]['nb_views'];
                $view->nb_phone_views  += $bulk[$key]['nb_phone_views'];
                $view->return_counters += $bulk[$key]['return_counters'];
                $view->date = $currentDate;

                $view->save();
            }
            $views[] = [
                $key => [
                    'nb_views'       => $view->nb_views,
                    'nb_phone_views' => $view->nb_phone_views,
                ],
            ];
        }

        return $views;
    }

    /**
     * Метод для вывода количества просмотров по id
     *
     * @param  ViewsRequestData      $request
     * @param  ViewsIdentifierObject $identifierObject
     * @return \array[][]
     */
    public function showCount(ViewsRequestData $request, ViewsIdentifierObject $identifierObject)
    {
        if ('bulk' != $identifierObject->getObjectId()) {
            $views = NbViews::where('projectId', '=', $identifierObject->getProjectId())
                ->where('entityId', '=', $identifierObject->getEntityId())
                ->where('objectId', '=', $identifierObject->getObjectId())
                ->selectRaw('nb_views, nb_phone_views')
                ->get();

            return [
                'data' => [
                    $identifierObject->getObjectId() => $views,
                ],
            ];
        }

        //Вывод просмотров пачкой
        $bulk  = $request->getBulk();
        $views = [];

        foreach ($bulk as $b) {
            $view = NbViews::where('projectId', '=', $identifierObject->getProjectId())
                ->where('entityId', '=', $identifierObject->getEntityId())
                ->where('objectId', '=', $b)
                ->selectRaw('nb_views, nb_phone_views')
                ->get();

            $views[] = [
                $b => $view,
            ];
        }

        return [
            "data" => $views,
        ];
    }

    /**
     * Метод для вывода количества просмотров по дате
     *
     * @param  ViewsRequestData      $request
     * @param  ViewsIdentifierObject $identifierObject
     * @return array
     */
    public function showCountByDate(ViewsRequestData $request, ViewsIdentifierObject $identifierObject)
    {
        $period = $request->getPeriod();
        $from   = '';
        $to     = '';

        foreach ($period as $key => $value) {
            $from = $period[$key]['from'];
            $to   = $period[$key]['to'];
        }

        $views = NbViews::where('projectId', '=', $identifierObject->getProjectId())
            ->where('entityId', '=', $identifierObject->getEntityId())
            ->where('objectId', '=', $identifierObject->getObjectId())
            ->whereBetween('date', [$from, $to])
            ->selectRaw('SUM(nb_views) as nb_views, SUM(nb_phone_views) as nb_phone_views')
            ->get();

        return [
            $identifierObject->getObjectId() => $views,
        ];
    }
}
