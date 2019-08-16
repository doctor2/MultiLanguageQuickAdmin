<?php

namespace App\Http\Controllers\Traits;

use App\Helpers\ImageService;
use App\Image;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Translation\Exception\NotFoundResourceException;

trait StorageImageTrait
{
    /**
     * Fetch the activity relationship.
     *
     * @return MorphMany
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'model');
    }

    public function getByName($name)
    {
        return $this->images->firstWhere(
            'name', $name
        );
    }

    public function saveImage($fields)
    {
        if(empty($fields['file'])){
            throw new NotFoundResourceException();
        }

        $filePath = $this->getProcessedImagePath($fields['file'], $fields['resize_setting']);

        $image = new Image([
            'path' => $filePath,
            'name' => $fields['image_name'],
            'additional' => $fields['additional']??[],
            'order' => $fields['order'] ?? 10,
            'active' => $fields['active'] ?? 1,
            'model_id'=> $this->id,
            'model_type' => get_class($this)
        ]);
        $image->save();

        return $image;
    }

    public function updateImage($fields)
    {
        $newField = [];

        if(!empty($fields['file'])){
            $newField['path'] = $this->getProcessedImagePath($fields['file'], $fields['resize_setting']);

            Storage::disk('public')->delete($fields['old_image_path']);
        }

        if(isset($fields['order'])){
            $newField['order'] = $fields['order'];
        }
        if(isset($fields['active'])){
            $newField['active'] = $fields['active'];
        }
        if(isset($fields['additional'])){
            $newField['additional'] = json_encode($fields['additional']) ??[];
        }
        $this->images()->where('name', $fields['image_name'])->update($newField);
    }

    public function saveOrUpdateByName($data)
    {
        if($this->getByName($data['image_name'])){
            $this->updateImage($data);
        } else{
            $this->saveImage($data);
        }
    }

    protected function getProcessedImagePath($filePath, $resizeSetting)
    {
        $path = strtolower(str_replace('\\','_', get_class($this)));

        return ImageService::resizeImage($filePath, $path, $resizeSetting);
    }


}
