<?php

namespace Common\Service;

class MarkdownService
{

    public $markdown;

    public function __construct($markdown)
    {
        $this->markdown = $markdown;
    }

    public function transform($text)
    {
        return $this->markdown->transform($text);
    }
}