<?php

namespace common\models\mall;

use common\models\BaseModel;
use common\models\Store;
use common\models\User;
use Yii;

/**
 * This is the model base class for table "{{%mall_product}}" to add your code.
 *
 * @property Category $category
 * @property Store $store
 */
class ProductBase extends BaseModel
{
    public $isAttribute = 1;

    /**
     * @return array|array[]
     */
    public function rules()
    {
        return [
            [['id'], 'safe'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['store_id'], 'exist', 'skipOnError' => true, 'targetClass' => Store::className(), 'targetAttribute' => ['store_id' => 'id']],
        ];
    }

    /** add function getXxxLabels here, detail in BaseModel **/

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'store_id' => Yii::t('app', 'Store ID'),
            'category_id' => Yii::t('app', 'Category ID'),
            'name' => Yii::t('app', 'Name'),
            'sku' => Yii::t('app', 'Sku'),
            'stock_code' => Yii::t('app', 'Stock Code'),
            'stock' => Yii::t('app', 'Stock'),
            'stock_warning' => Yii::t('app', 'Stock Warning'),
            'weight' => Yii::t('app', 'Weight'),
            'volume' => Yii::t('app', 'Volume'),
            'price' => Yii::t('app', 'Price'),
            'market_price' => Yii::t('app', 'Market Price'),
            'cost_price' => Yii::t('app', 'Cost Price'),
            'wholesale_price' => Yii::t('app', 'Wholesale Price'),
            'thumb' => Yii::t('app', 'Thumb'),
            'images' => Yii::t('app', 'Images'),
            'tags' => Yii::t('app', 'Tags'),
            'brief' => Yii::t('app', 'Brief'),
            'content' => Yii::t('app', 'Content'),
            'seo_title' => Yii::t('app', 'Seo Title'),
            'seo_keywords' => Yii::t('app', 'Seo Keywords'),
            'seo_description' => Yii::t('app', 'Seo Description'),
            'brand_id' => Yii::t('app', 'Brand ID'),
            'vendor_id' => Yii::t('app', 'Vendor ID'),
            'attribute_set_id' => Yii::t('app', 'Attribute Set ID'),
            'star' => Yii::t('app', 'Star'),
            'sales' => Yii::t('app', 'Sales'),
            'click' => Yii::t('app', 'Click'),
            'type' => Yii::t('app', 'Type'),
            'sort' => Yii::t('app', 'Sort'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStore()
    {
        return $this->hasOne(Store::className(), ['id' => 'store_id']);
    }

}
