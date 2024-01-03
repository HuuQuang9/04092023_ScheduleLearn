<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class BaseModel extends Model
{
    use HasFactory;

    /*
     * @param: fillable dùng để lưu các cột trong bảng dữ liệu vào 1 mảng
     * @param: modelClass dùng để lưu giá trị của model class
     * */
    protected $fillable = [];
    protected $modelClass;

    /**
     * Thêm mới dữ liệu
     * @param $params: biến truyền vào
     * @return mixed: mảng
     */
    function addItem($params)
    {
        //biến modelClass sẽ cho biết nó sẽ gọi tới model nào
        //Nó được truyền giá trị từ Model cái mà được gọi thông qua controller và được kế thừa từ baseModel
        $model = new $this->modelClass();
        //biến $params được gửi tới thông qua form bao gồm $column(tên cột trong bảng dữ liệu) và $param(giá trị sẽ lưu vào cột đó)
        if(is_array($params)) {
            foreach ($params as $column => $param) {
                //kiểm tra xem các dữ liệu gửi tới trong mảng params có nằm trong fillable không
                if (in_array($column, $this->fillable)) {
                    if ($column == 'password') {
                        $model->$column = Hash::make($param);
                    } else {
                        $model->$column = strip_tags(trim($param));
                    }
                }
            }
        }
        $model->save();
        return $model->id;
    }

    /**
     * Cập nhật dữ liệu
     * @param $id: ID dòng cập nhật
     * @param $params: biến cập nhật truyền vào
     * @return bool
     */
    function updateItem($id, $params)
    {
        //biến modelClass sẽ cho biết nó sẽ gọi tới model nào
        //Nó được truyền giá trị từ Model cái mà được gọi thông qua controller và được kế thừa từ baseModel
        $model = $this->modelClass;
        $model = $model::find($id);

        //biến $params được gửi tới thông qua form bao gồm $column(tên cột trong bảng dữ liệu) và $param(giá trị sẽ lưu vào cột đó)
        foreach ($params as $column => $param) {
            //kiểm tra xem các dữ liệu gửi tới trong mảng params có nằm trong fillable không
            if ((in_array($column, $this->fillable) && $param) || (in_array($column, $this->fillable) && $param == 0)) {
                $model->$column = strip_tags(trim($param));
            }
        }
        $model->save();
        return true;
    }

    /**
     * Lấy chi tiết dữ liệu
     * @param $id: ID dòng dữ liệu
     * @return mixed
     */
    function getDetail($id)
    {
        date_default_timezone_set('UCT');
        $model = $this->modelClass;
        return $model::where('id', $id)->where('delete', false)->first();
    }

    function getDetailByClass($id){
        $model = $this ->modelClass;
        return $model::with('subject')
            -> with('lecturer')
            -> with('classroom')
            -> where('class_id', $id)
            -> where('delete', false)
            -> get()->toArray();
    }

    /**
     * Xóa dòng dữ liệu
     * @param $arrIds: các ID dòng dữ liệu
     * @return mixed
     */
    function removeItem($id)
    {
        $model = $this->modelClass;
        return $model::where('id', $id)->update(['delete' => true]);
    }

    /**
     * Lấy tất cả dữ liệu
     * @return mixed: mảng
     */
    function getAll() {
        date_default_timezone_set('UCT');
        $model = $this->modelClass;
        return $model::where('delete', false)
            ->orderBy('id', 'desc')
            ->get()->toArray();
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        $array = [
            'created_at',
            'updated_at',
        ];

        if (in_array($key, $array)) {
            $timezone = new \DateTime('now');

            if (!($value instanceof Carbon)) {
                $value = Carbon::parse($value);
            }

            return $this->attributes[$key] = Carbon::createFromFormat('Y-m-d H:i:s', $value, $timezone->getTimezone())
                ->setTimezone(config('app.timezone'));
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        $array = [
            'created_at',
            'updated_at',
        ];

        if (in_array($key, $array)) {
            $timezone = new \DateTime('now');
            $value = $this->getAttributeValue($key);

            if (!($value instanceof Carbon)) {
                $value = Carbon::parse($value);
            }

            return Carbon::createFromFormat('Y-m-d H:i:s', $value, config('app.timezone'))
                ->setTimezone($timezone->getTimezone());
        }

        return parent::getAttribute($key);
    }

}
