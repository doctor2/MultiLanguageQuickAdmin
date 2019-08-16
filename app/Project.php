<?php
namespace App;

use App\Http\Controllers\Traits\StorageImageTrait;
use Dimsav\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Project
 *
 * @package App
 * @property string $title
 * @property text $additional
 * @property integer $year
 * @property integer $order
 * @property tinyInteger $active
 * @property string $city
*/
class Project extends Model
{
    use SoftDeletes;
    use Translatable;
    use StorageImageTrait;

    protected $fillable = ['year', 'order', 'active', 'city_id'];
    protected $hidden = [];

    /**
     * @var array
     */
    public $translatedAttributes = [
        'title',
        'additional',
        'additional_multi'
    ];

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setYearAttribute($input)
    {
        $this->attributes['year'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setOrderAttribute($input)
    {
        $this->attributes['order'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setCityIdAttribute($input)
    {
        $this->attributes['city_id'] = $input ? $input : null;
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id')->withTrashed();
    }

    public function getPreviewImagePathAttribute()
    {
        $preview_image_path = null;
        if ($image = $this->getByName('preview_image')) {
            $preview_image_path = $image->path;
        }

        return $preview_image_path;
    }

    public function getPreviewImageFullAttribute()
    {
        $preview_image_full = null;
        if ($image = $this->getByName('preview_image')) {
            $preview_image_full = $image->full_path;
        }

        return $preview_image_full;
    }

    public function getTitleAttribute()
    {
        return $this->translate()->title;
    }

}
