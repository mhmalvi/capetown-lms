<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileHandler
{
    private $file,
        $name,
        $path;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function getPath()
    {
        return 'storage/' . $this->path . '/';
    }

    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    public function getExtension()
    {
        try {
            $elements = explode('.', $this->name);
            return $elements[count($elements) - 1];
        } catch (\Exception $e) {
            return null;
        }
    }

    public function save()
    {
        if (Storage::exists("public/" . $this->path)) {
            Storage::makeDirectory("public/" . $this->path);
        }

        $file_data = explode(',', $this->file)[1];

        Storage::put(
            'public/' . $this->path . '/' . $this->name,
            base64_decode($file_data)
        );
    }
}
