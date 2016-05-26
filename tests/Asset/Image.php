<?php
namespace Strapieno\NightClubCover\ApiTest\Asset;

use Matryoshka\Model\Object\ActiveRecord\ActiveRecordInterface;
use Matryoshka\Model\Object\IdentityAwareInterface;
use Strapieno\NightClubCover\Model\Entity\CoverAwareInterface;
use Strapieno\NightClubCover\Model\Entity\CoverAwareTrait;

/**
 * Class Image
 */
class Image implements CoverAwareInterface, ActiveRecordInterface
{
    use CoverAwareTrait;

    public function save()
    {
        // TODO: Implement save() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

    public function setId($id)
    {
        // TODO: Implement setId() method.
    }

    public function getId()
    {
        // TODO: Implement getId() method.
    }
}