<?php
namespace App;

use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class City
 *
 * @package App
 * @property string $key
 * @property integer $order
 * @property tinyInteger $active
*/
class City extends Model
{
    use SoftDeletes;
    use Translatable;

    protected $fillable = ['key', 'order', 'active'];
    protected $hidden = [];

    /**
     * @var array
     */
    public $translatedAttributes = [
        'name'
    ];

    /**
     * @var array
     */
    protected $attributes = [
        'order' => 10,
        'active' => 1
    ];

    public function getNameAttribute()
    {
        return $this->translate()->name;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOrderAttribute($input)
    {
        $this->attributes['order'] = $input ? $input : null;
    }

}
