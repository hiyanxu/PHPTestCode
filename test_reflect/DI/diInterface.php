<?php
namespace TestDI\InterfaceDI;
interface IDi {
    public function bind($abstract, $concrete);

    public function make($abstract, $parameters);

    public function get($abstract);

    public function has($abstract);
}
