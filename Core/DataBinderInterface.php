<?php

namespace Core;
interface DataBinderInterface
{
    public function bind($formDate, $className);
}