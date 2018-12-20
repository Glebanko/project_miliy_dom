<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 06.03.17
 * Time: 10:34
 */

namespace backend\modules\prom\behaviors;

use yii\base\Behavior;
use yii\base\InvalidConfigException;

class PromCategoryBehavior extends Behavior
{
    const BATCH_MAX_SIZE = 100;

    /** @var callable */
    public $dataClosure;

    /** @var callable */
    public $scope;

    public function init()
    {
        if (!is_callable($this->dataClosure)) {
            throw new InvalidConfigException('YmlCategoryBehavior::$dataClosure isn\'t callable.');
        }
    }

    public function generatePromCategories()
    {
        $result = [];
        $n = 0;

        /** @var \yii\db\ActiveRecord $owner */
        $owner = $this->owner;
        $query = $owner::find();
        if (is_callable($this->scope)) {
            call_user_func($this->scope, $query);
        }

        foreach ($query->each(self::BATCH_MAX_SIZE) as $model) {
            $data = call_user_func($this->dataClosure, $model);

            if (empty($data)) {
                continue;
            }

            $result[$n]['id'] = $data['id'];
            $result[$n]['name'] = $data['name'];
            $result[$n]['parentId'] = isset($data['parentId'])
                ? $data['parentId']
                : null;

            ++$n;
        }
        return $result;
    }
}
