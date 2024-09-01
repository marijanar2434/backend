<?php

namespace App\VehicleApp\IdentityAccess\Main\Application\Query\Access;

use App\Common\Application\Query\CollectionQuery;
use App\Common\Infrastructure\Delivery\Symfony\Bus\RequiresAuthorization;

class UserRolesCollectionQuery extends CollectionQuery implements RequiresAuthorization
{
    /**
     * @var string
     */
    private $userId;

    /**
     * @var boolean
     */
    private $attached;

    /**
     * UserRolesCollectionQuery Constructor
     *
     * @param string $userId
     * @param boolean $attached
     * @param int $page
     * @param int $limit
     * @param array $filter
     * @param array $order
     */
    public function __construct($userId, $attached, $page, $limit, $filter = [], $order = [])
    {
        parent::__construct($page, $limit, $filter, $order);
        $this->userId = $userId;
        $this->attached = $attached;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return boolean
     */
    public function getAttached(): bool
    {
        return $this->attached;
    }
}
