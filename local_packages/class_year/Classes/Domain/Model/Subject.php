<?php

declare (strict_types = 1);

class Subject {

    /**
     * @var string $title 
     */
    protected string $title;

    /**
     * Get $title
     *
     * @return  string
     */ 
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set $title
     *
     * @param  string  $title  $title
     *
     * @return  self
     */ 
    public function setTitle(string $title)
    {
        $this->title = $title;

        return $this;
    }
}