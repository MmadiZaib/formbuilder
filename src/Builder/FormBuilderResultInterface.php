<?php

namespace App\Builder;

interface FormBuilderResultInterface
{
    public function addReplyTo($replyTo);

    public function getReplyTo();

    public function getData();

    public function addPair($label, $value);

    public function getPairs();

    public function getModel();

    public function getForm();
}