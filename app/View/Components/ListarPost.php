<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListarPost extends Component
{

    //Se declara esta variable para poder obtener a posts desde la vista
    public $posts;

    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.listar-post');
    }
}
