<?php

namespace App\Models\Concerns;

use SplFileInfo;


trait HasVariants
{
    public function getVariant(string $attribute = 'image', string $variant = 'original'): string|null
    {
        $original = $this->{$attribute};
        $file = new SplFileInfo(public_path('storage/' . $original));

        if (!$file->getRealPath()) return null;

        if ($variant === 'original') {
            return $original;
        }

        $extension = '.' . $file->getExtension();
        $variantPath = str_replace($extension, '-' . $variant . $extension,  $original);

        return $variantPath;
    }
}
