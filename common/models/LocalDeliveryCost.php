<?php
namespace common\models;
use pastuhov\ymlcatalog\LocalDeliveryCostInterface;
/**
 * @inheritdoc
 * @deprecated
 */
class LocalDeliveryCost implements LocalDeliveryCostInterface
{
    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return 'true';
    }
} ?>