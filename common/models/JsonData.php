<?php

namespace common\models;

use yii\helpers\Html;

/**
 * This is the model class for table "jsondata".
 *
 * @property int $id
 * @property string $data
 */
class JsonData extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jsondata';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data'], 'required'],
            [['data'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'data' => 'Data',
        ];
    }

}
