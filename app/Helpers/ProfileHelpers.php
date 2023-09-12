<?php


function profileImageUrl($image)
{
    $base_image = URL::to('/profileImages') . '/';
    return $base_image . $image;
}