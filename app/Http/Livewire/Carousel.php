<?php

namespace App\Http\Livewire;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Image;
use Livewire\WithFileUploads;

class Carousel extends Component
{
    use WithFileUploads;
    public $carousels;
    public $title;
    public $text;
    public $file;

    public function createElement()
    {
        $carousel = new \App\Models\Carousel([
            'title' => $this->title,
            'text' => $this->text,
        ]);
        $carousel->save();
        $fileName = time().uniqid(rand()).'.'.$this->file->getClientOriginalExtension();
        $file = new File(['name' => $fileName]);
        $carousel->file()->save($file);

        $image = $this->file;
        $img = Image::make($image->getRealPath())->encode('jpg', 65)->fit(1200, 400, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });
        $img->brightness(-50);
        $img->stream();
        Storage::disk('local')->put('public/img/carousel' . '/' . $fileName, $img, 'public');
    }

    public function deleteCarousel(\App\Models\Carousel $carousel)
    {
        $carousel->delete();
    }

    public function render()
    {
        $this->carousels = \App\Models\Carousel::all();
        return view('livewire.carousel');
    }
}
