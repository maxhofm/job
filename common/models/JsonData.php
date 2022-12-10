<?php

namespace common\models;

use Exception;
use yii\base\InvalidArgumentException;
use yii\helpers\Html;
use yii\helpers\Json;

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
            [['data'], 'trim'],
            [['data'], 'safe'],
            [['data'], 'validateJson'],
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

    /**
     * Валодатор json
     * @param $attribute
     * @param $params
     * @param $validator
     * @return void
     */
    public function validateJson($attribute, $params, $validator)
    {
        if ( is_string( $this->$attribute ) ) {
            try {
                $this->$attribute = Json::decode($this->$attribute);
            } catch (InvalidArgumentException $e) {
                $this->$attribute = $this->getOldAttribute($attribute);
                $this->addError('data', $e->getMessage());
            }
        }
    }

}
