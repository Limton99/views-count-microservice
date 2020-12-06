<?php
namespace App\DataTransferObjects;

use Spatie\DataTransferObject\DataTransferObject;

/**
 * DTO для идентификаторов проекта
 */
class ViewsIdentifierObject extends DataTransferObject
{
    /**
     * Идентификатора проекта
     *
     * @var string $projectId
     */
    public $projectId;

    /**
     * Идентификатора сущности
     *
     * @var string $entityId
     */
    public $entityId;

    /**
     * Идентификатора объекта
     *
     * @var string $objectId
     */
    public $objectId;

    /**
     * Метод заполнения
     *
     * @param  string                $projectId
     * @param  string                $entityId
     * @param  string                $objectId
     * @return ViewsIdentifierObject
     */
    public static function fromParams($projectId, $entityId, $objectId)
    {
        return new static([
            'projectId' => $projectId,
            'entityId'  => $entityId,
            'objectId'  => $objectId,
        ]);
    }

    /**
     * Метод получения идентификатора проекта
     *
     * @return mixed
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * Метод получения идентификатора сущности
     *
     * @return mixed
     */
    public function getEntityId()
    {
        return $this->entityId;
    }

    /**
     * Метод получения идентификатора объекта
     *
     * @return mixed
     */
    public function getObjectId()
    {
        return $this->objectId;
    }
}
