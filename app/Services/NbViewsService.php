<?php
namespace App\Services;

use App\DataTransferObjects\ViewsIdentifierObject;
use App\DataTransferObjects\ViewsRequestData;

/**
 * Интерфейс сервиса просмотров
 */
interface NbViewsService
{
    /**
     * Обявление метода для увеличения просмотров
     *
     * @param ViewsRequestData      $request
     * @param ViewsIdentifierObject $identifierObject
     */
    public function incrementView(ViewsRequestData $request, ViewsIdentifierObject $identifierObject);

    /**
     * Обявление метода для вывода просмотров
     *
     * @param ViewsRequestData      $request
     * @param ViewsIdentifierObject $identifierObject
     */
    public function showCount(ViewsRequestData $request, ViewsIdentifierObject $identifierObject);

    /**
     * Обявление метода для вывода просмотров по дате
     *
     * @param ViewsRequestData      $request
     * @param ViewsIdentifierObject $identifierObject
     */
    public function showCountByDate(ViewsRequestData $request, ViewsIdentifierObject $identifierObject);
}
