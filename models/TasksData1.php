<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tasks_data_1".
 *
 * @property string|null $Task
 * @property int $taskNumber
 * @property string|null $taskStatus
 * @property string|null $Task_start_date
 * @property string|null $Task_end_date
 * @property string|null $taskInfo
 */
class TasksData1 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks_data_1';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Task'], 'string', 'max' => 50],
            [['taskStatus'], 'string', 'max' => 20],
            [['Task_start_date', 'Task_end_date'], 'string', 'max' => 25],
            [['taskInfo'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Task' => 'Task',
            'taskNumber' => 'Task Number',
            'taskStatus' => 'Task Status',
            'Task_start_date' => 'Task Start Date',
            'Task_end_date' => 'Task End Date',
            'taskInfo' => 'Task Info',
        ];
    }
}
