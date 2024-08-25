<?php

namespace App\Jobs;

use SplFileInfo;
use Intervention\Image\ImageManager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class ResizeVariants implements ShouldQueue
{
    use Queueable;

    public string $path;

    public Model $model;

    /**
     * Create a new job instance.
     */
    public function __construct(Model $model = null)
    {
        $this->model = $model;
        $this->path = $this->model->thumbnail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->model->variants as $attribute => $variants) {
            $path = $this->model->{$attribute};

            if (!$path) continue;

            $file = new SplFileInfo(public_path('storage/' . $path));
            $this->manageVariant($file, $variants);
        }
    }

    protected function manageVariant(SplFileInfo $file, array $variants): void
    {
        if (!$file->getRealPath()) return;

        foreach ($variants as $variantName => $dimensions) {
            $this->resize($file, $variantName, $dimensions);
        }
    }

    protected function resize(SplFileInfo $file, string $variantName, array $dimensions): void
    {
        //define null by default to aviod having to use the "??" operator everywhere
        $dimensions = array_merge([
            'width' => null,
            'height' => null,
        ], $dimensions);

        //define null by default to aviod having to use the "??" operator everywhere
        $variantPath = $this->buildPath($file, $variantName);

        $image = ImageManager::imagick()
            ->read($file->getRealPath());

        if ($dimensions['width'] && $dimensions['height']) {
            $image->cover(...$dimensions);
        } else {
            $image->scale(...$dimensions);
        }

        $image->save($variantPath);
    }

    protected function buildPath(SplFileInfo $file, string $variantName): string
    {
        // return only 'filename' without the extention
        $fileName = $file->getBaseName("." . $file->getExtension());

        // return the full path with filename replaced by "filename-$variant";
        return str_replace($fileName, $fileName . '-' . $variantName, $file->getRealpath());
    }
}
