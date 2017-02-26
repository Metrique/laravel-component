<?php

namespace Metrique\Constituent;

use Illuminate\Contracts\View\View;
use Metrique\Constituent\ConstituentInterface;

class ConstituentViewComposer
{
    protected $constituent;

    public function __construct(ConstituentInterface $constituent)
    {
        $this->constituent = $constituent;
    }

    public function compose(View $view)
    {
        $view->with('constituent', $this->constituent);
    }
}
