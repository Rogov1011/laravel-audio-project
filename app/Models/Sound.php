<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Sound extends Model
{
    use HasFactory, HasSlug;
    
    protected $fillable = [
        'title',
        'content',
        'sound',
        'category_id',
        'is_published'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function review()
    {
        return $this->hasMany(Review::class);
    }
    public function Complaint()
    {
        return $this->hasMany(Complaint::class);
    }
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function uploadSound($file)
    {
        if ($file == null) return false;
        $filename = $file->getClientOriginalName();
        $path = 'sounds/sounds_' . $this->id . '/';
        $this->removeSound();
        $file->storeAs($path, $filename, 'uploads');
        $this->sound = $path . $filename;
        $this->save();
    }

    public function getSound()
    {
        $sound = $this->sound;

        if ($sound) {
            return asset(('uploads/' . $sound));
        }
        return asset('assets/images/no_image.png');
    }

    public function removeSound()
    {
        if ($this->sound) {
            Storage::disk('uploads')->delete($this->sound);
            $this->sound = null;
            $this->save();
        }
    }
    
    public function remove(){
        $this->removeSound();
        $this->delete();
    }

    public function published(){
        if ($this->is_published){
            return '<span class="badge text-bg-success">да</span>';
        }return '<span class="badge text-bg-danger">нет</span>';
    }
}
