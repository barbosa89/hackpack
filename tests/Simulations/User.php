<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Barbosa\HackPack\Simulations;

/**
 * Description of User
 *
 * @author barbosa
 */
class User
{
    private $name;
    private $data;

    public function __construct($name = '', array $data = [])
    {
        $this->name = $name;
        $this->data = $data;
    }
    
    public function getName()
    {
        return $this->name;
    }
    
    public function getData()
    {
        return $this->data;
    }
}
