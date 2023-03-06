<?php

namespace App\Http\Livewire\{{ path_with_backslashes }};

use Livewire\Component;

class Create extends Component
{
    public function render()
    {
        return view('livewire.{{ view_modal_path }}');
    }
}
