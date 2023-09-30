<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $message
 * @property string $file
 * @property int $line
 * @property string $trace
 * @property string $request
 * @property int $user_id
 * @property string $url
 * @property string $err_code
 * @property string $created_at
 * @property string $updated_at
 */
class ErrorLog extends Model
{
    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['message', 'file', 'line', 'trace', 'request', 'user_id', 'url', 'err_code', 'created_at', 'updated_at'];

    /**
     * @param \Throwable $e
     * @return int|mixed
     */
    public static function newError($e,$code=null)
    {
        if (!$code)
            $code = $e->getCode();
        $url = '';
        try {
            $url = \Request::getRequestUri();
        } catch (\Throwable $e) {
        }
        $model = new ErrorLog();
        $model->message = $e->getMessage();
        $model->file = $e->getFile();
        $model->line = $e->getLine();
        $model->trace = $e->getTraceAsString();
        $model->err_code = $code;
        $model->request = json_encode(request()->all());
        $model->user_id = \Auth::user() ? \Auth::user()->id : 0;
        $model->url = $url;
        $model->save();
        return $model->id;
    }

}
