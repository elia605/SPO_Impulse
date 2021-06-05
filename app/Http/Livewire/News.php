<?php

namespace App\Http\Livewire;

use App\Models\File;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use Image;

class News extends Component
{
    use WithFileUploads;

    public $news;
    public $title;
    public $text;
    public $tag;
    public $file;

    public function mount()
    {

    }

    public function deleteNews($news)
    {
        $this->news->find($news['id'])->delete();
    }

    public function editNews ($news)
    {
        $this->title = $news['title'];
        $this->text = $news['text'];
        $this->tag = $news['tag'];
        $this->file = $news['file'];
    }

    public function createNews()
    {
        $news = new \App\Models\News();
        $news->title = $this->title;
        $news->text = $this->text;
        $news->user_id = Auth::user()->id;
        $news->tag = $this->tag;
        $news->save();

        $fileName = time().uniqid(rand()).'.'.$this->file->getClientOriginalExtension();
        $file = new File(['name' => $fileName]);
        $news->file()->save($file);

        $image = $this->file;
        $img = Image::make($image->getRealPath())->encode('jpg', 65)->fit(300, null, function ($c) {
            $c->aspectRatio();
            $c->upsize();
        });
        $img->stream();
        Storage::disk('local')->put('public/img/news' . '/' . $fileName, $img, 'public');

    }

    public function render()
    {
        $this->news = \App\Models\News::all();
        return view('livewire.news');
    }
}
