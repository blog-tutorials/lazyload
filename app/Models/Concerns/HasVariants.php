<?php

namespace App\Models\Concerns;

use SplFileInfo;


trait HasVariants
{
    public function getVariant(string $attribute = 'image', string $variant = 'original'): string|null
    {
        //returns something like "posts/filename.png"
        $original = $this->{$attribute};
        $file = new SplFileInfo(public_path('storage/' . $original));

        if (!$file->getRealPath()) return null;

        if ($variant === 'original') {
            return $original;
        }

        $fileName = $file->getBaseName("." . $file->getExtension());
        $variantPath = str_replace($fileName, $fileName . '-' . $variant,  $original);

        return $variantPath;
    }
}
