<?php

namespace common\models\mall;

use Yii;
use common\models\User;
use common\models\Store;

/**
 * This is the model class for table "{{%mall_attribute_set}}".
 *
 * @property int $id
 * @property int $store_id 商家
 * @property string $name 名称
 * @property string|null $attribute_ids 属性列表
 * @property string $description 简述
 * @property int $type 类型
 * @property int $sort 排序
 * @property int $status 状态
 * @property int $created_at 创建时间
 * @property int $updated_at 更新时间
 * @property int $created_by 创建用户
 * @property int $updated_by 更新用户
 */
class AttributeSet extends AttributeSetBase
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%mall_attribute_set}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['store_id', 'type', 'sort', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name'], 'required'],
            [['attribute_ids'], 'safe'],
            [['name', 'description'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        if (Yii::$app->language == Yii::$app->params['sqlCommentLanguage']) {
            return array_merge(parent::attributeLabels(), [
                'id' => Yii::t('app', 'ID'),
                'store_id' => '商家',
                'name' => '名称',
                'attribute_ids' => '属性列表',
                'description' => '简述',
                'type' => '类型',
                'sort' => '排序',
                'status' => '状态',
                'created_at' => '创建时间',
                'updated_at' => '更新时间',
                'created_by' => '创建用户',
                'updated_by' => '更新用户',
            ]);
        } else {
            return array_merge(parent::attributeLabels(), [
                'id' => Yii::t('app', 'ID'),
                'store_id' => Yii::t('app', 'Store ID'),
                'name' => Yii::t('app', 'Name'),
                'attribute_ids' => Yii::t('app', 'Attribute Ids'),
                'description' => Yii::t('app', 'Description'),
                'type' => Yii::t('app', 'Type'),
                'sort' => Yii::t('app', 'Sort'),
                'status' => Yii::t('app', 'Status'),
                'created_at' => Yii::t('app', 'Created At'),
                'updated_at' => Yii::t('app', 'Updated At'),
                'created_by' => Yii::t('app', 'Created By'),
                'updated_by' => Yii::t('app', 'Updated By'),
            ]);
        }
    }
}
