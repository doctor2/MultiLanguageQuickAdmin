<?php
namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Setting
 *
 * @package App
 * @property string $key
 * @property integer $order
 * @property text $description
*/
class Setting extends Model
{
    use SoftDeletes;
    use Translatable;

    protected $fillable = ['key', 'order', 'description'];
    protected $hidden = [];

    public $translatedAttributes = [
        'name'
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'order' => 10,
    ];

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOrderAttribute($input)
    {
        $this->attributes['order'] = $input ? $input : null;
    }

    public function getNameAttribute()
    {
        return $this->translate()->name;
    }
}
