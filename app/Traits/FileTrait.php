<?php

namespace App\Traits;

trait FileTrait
{


    /**
     * SaveFile
     */
   public function saveFiles($files, $collection = null, $hasDefault = true, $disk = 'public')
    {

        $collection = $collection ?? $this->mediaCollection;
        if (is_array($files)) {

            foreach ($files as $key => $file) {
                $media = $this->addMedia($file)->usingFileName(time().'.'.$file ->extension())->toMediaCollection($collection, $disk);
            }
        } else {
            $this->clearMediaCollectionExcept($collection);
            // dd($collection , $files , time().'.'.$files->extension());
            $media = $this->addMedia($files)->usingFileName(time().'.'.$files->extension())->toMediaCollection($collection, $disk);
        }

        return $media;
    }

    /**
     * updateFile
     */
    public function updateFile($files, $collection = null, $hasDefault = true, $disk=null)
    {
        $collection = $collection ?? $this->mediaCollection;
        $disk = $disk ? $disk:'public';
        $this->clearMediaCollection($collection);
        $this->saveFiles($files, $collection, $hasDefault = true, $disk);
    }


    /**
     * getDefaultImageUrlAttribute
     */
    public function getDefaultImageUrlAttribute(): string
    {
        if ($image = $this->getMedia($this->mediaCollection)->first()) {

            return $image->getFullUrl();

        }

        return asset('/images/default.jpg');
    }

    /**
     *
     * getImgUrlAttribute
     */
    public function getImgUrlAttribute(): string
    {
        if ($image = $this->getMedia($this->mediaCollection)->first()) {

            return $image->getFullUrl();

        }

        return asset('/images/default.jpg');
    }

    /**
     * getImagesUrlAttribute
     */
    public function getImagesUrlAttribute(): array
    {
        $images = $this->getMedia($this->mediaCollection)->map(function ($image) {
            return $image->getFullUrl();
        })->toArray();

        return $images;
    }

    /**
     * GetImagesAttribute
     */
    public function getImagesAttribute()
    {
        return $this->getMedia($this->mediaCollection);
    }


}
