<?php

namespace App\Http\Livewire;

use Livewire\Component;

class QueryComments extends Component
{
    protected $listeners = ['refresh-query' => '$refresh'];

    public $contents;
    public function render()
    {
        return view('livewire.query-comments');
    }
}
