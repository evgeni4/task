<?php


namespace Core;


class DataBinder implements DataBinderInterface
{
    /**
     * @param $formDate
     * @param $className
     * @return mixed
     */
    public function bind($formDate, $className)
    {
        $object = new $className;
        foreach ($formDate as $key => $value) {
            $methodName = 'set' . implode("",
                    array_map(function ($el) {
                        return ucfirst($el);
                    }, explode("_", $key)));
            if (method_exists($object, $methodName)) {
                $object->$methodName($value);
            }
        }
        return $object;
    }
}