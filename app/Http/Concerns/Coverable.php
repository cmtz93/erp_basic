<?php

namespace App\Http\Concerns;
use Illuminate\Support\Facades\Storage;

trait Coverable
{
  public function setCoverAttribute($file = null)
  {
    if (is_file($file)) {
      $filename = str_random(15) . '.' . $file->extension();
      $file->move(public_path($this->cover_path), $filename);
      $path = $this->cover_path . $filename;
      $this->attributes['cover'] = $path;
    } else {
      $this->attributes['cover'] = $file;
    }
  }
}
