<?php

namespace app\models;

use Yii;
use creocoder\nestedsets\NestedSetsBehavior;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property int $tree
 * @property int $lft
 * @property int $rgt
 * @property int $depth
 * @property string $name
 * @property string $url
 * @property string|null $description
 */
class Menu extends \yii\db\ActiveRecord
{
    public $sub;

    public function behaviors() {
        return [
            'tree' => [
                'class' => NestedSetsBehavior::className(),
                 'treeAttribute' => 'tree',
                // 'leftAttribute' => 'lft',
                // 'rightAttribute' => 'rgt',
                // 'depthAttribute' => 'depth',
            ],
            'htmlTree'=>[
                'class' => \wokster\treebehavior\NestedSetsTreeBehavior::className()
            ],
        ];
    }

    public function transactions()
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find()
    {
        return new MenuQuery(get_called_class());
    }
    public static function tableName()
    {
        return 'menu';
    }


    public function rules()
    {
        return [
            [[ 'name', 'url'], 'required'],
            [['tree', 'lft', 'rgt', 'depth', 'sub'], 'integer'],
            [['description'], 'string'],
            [['name', 'url'], 'string', 'max' => 255],
            [['tree', 'lft', 'rgt', 'depth',], 'safe'],
        ];
    }


    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tree' => 'Tree',
            'lft' => 'Lft',
            'rgt' => 'Rgt',
            'depth' => 'Depth',
            'name' => 'Name',
            'url' => 'Url',
            'description' => 'Description',
        ];
    }


}
