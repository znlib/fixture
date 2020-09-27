<?php

namespace ZnLib\Fixture\Domain\Libs;

interface FixtureInterface
{

    public function load();
    public function unload();
    public function deps();

}
