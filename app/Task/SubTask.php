<?php

namespace App\Task;

use App\Events\Task\SubTask\SubTaskCreated;
use App\Events\Task\SubTask\SubTaskDeleted;
use App\Events\Task\SubTask\SubTaskUpdated;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Task\SubTask.
 *
 * @property int $task_id
 * @property int $id
 * @property string $content
 * @property bool $is_finish
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Task\Task $Task
 * @method static \Illuminate\Database\Query\Builder|\App\Task\SubTask whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Task\SubTask whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Task\SubTask whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Task\SubTask whereIsFinish($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Task\SubTask whereTaskId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Task\SubTask whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class SubTask extends Model
{
    protected $fillable = [
        'content', 'task_id',
    ];

    /**
     * タイミングイベント定義。
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => SubTaskCreated::class,
        'updated' => SubTaskUpdated::class,
        'deleted' => SubTaskDeleted::class,
    ];

    /**
     * 一个附属任务属于一个任务
     * 一对一
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function Task()
    {
        return $this->hasOne('App\Task\Task', 'id', 'task_id');
    }
}
