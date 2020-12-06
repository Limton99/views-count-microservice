<?php
namespace App\DataTransferObjects;

use App\Http\Requests\ViewRequest;
use Spatie\DataTransferObject\DataTransferObject;

/**
 * DTO для запросов
 */
class ViewsRequestData extends DataTransferObject
{
    /**
     * Количества Просмтров
     *
     * @var mixed $nb_views
     */
    public $nb_views;
    /**
     * Количества Телефонных Просмтров
     *
     * @var mixed $nb_phone_views
     */
    public $nb_phone_views;
    /**
     * Количества Возврощаемых Просмтров
     *
     * @var mixed $return_counters
     */
    public $return_counters;
    /**
     * Период Времени
     *
     * @var mixed $period
     */
    public $period;

    /**
     * Период Времени
     *
     * @var mixed $bulk
     */
    public $bulk;

    /**
     * Метод заполнения
     *
     * @param  ViewRequest      $request
     * @return ViewsRequestData
     */
    public static function fromRequest(ViewRequest $request)
    {
        return new static([
            'nb_views'        => $request->get('nb_views'),
            'nb_phone_views'  => $request->get('nb_phone_views'),
            'return_counters' => $request->get('return_counters'),
            'period'          => $request->get('period'),
            'bulk'            => $request->get('data'),
        ]);
    }

    /**
     * Метод получения количества просмотров
     *
     * @return mixed
     */
    public function getNbViews()
    {
        return $this->nb_views;
    }

    /**
     * Метод получения количества телефонных просмотров
     *
     * @return mixed
     */
    public function getNbPhoneViews()
    {
        return $this->nb_phone_views;
    }

    /**
     * Метод получения количества возврощаемых просмотров
     *
     * @return mixed
     */
    public function getReturnCounters()
    {
        return $this->return_counters;
    }

    /**
     * Метод получения количества просмотров за определенный период
     *
     * @return mixed
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * Метод получения количества просмотров пачкой
     *
     * @return mixed
     */
    public function getBulk()
    {
        return $this->bulk;
    }
}
