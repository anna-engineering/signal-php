<?php

namespace A;

class Signal
{
    /**
     * @var callable[]
     */
    protected array $callables = [];

    public function connect(callable $callback)
    {
        $this->callables[] = $callback;
    }

    public function disconnect(callable $callback)
    {
        foreach ($this->callables as $id => $callable)
        {
            if ($callback === $callable)
            {
                unset($this->callables[$id]);
                return;
            }
        }
    }

    public function __invoke()
    {
        $args = func_get_args();

        foreach ($this->callables as $callable)
        {
            call_user_func_array($callable, $args);
        }
    }
}
