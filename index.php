<?php namespace x;

function avatar($avatar, array $lot = []) {
    if ($avatar) {
        return $avatar;
    }
    $size = \array_shift($lot) ?: 80;
    return 'data:image/svg+xml;base64,' . base64_encode('<svg height="' . $size . '" version="1.1" viewBox="0 0 200 200" width="' . $size . '" xmlns="http://www.w3.org/2000/svg"><path d="M200-0.5H0v200h26.099c2.885-35.293,24.07-64.381,52.419-74.319C64.372,117.596,54.75,102.674,54.75,85.5 c0-24.853,20.146-45,45-45c24.853,0,45,20.147,45,45c0,17.095-9.533,31.963-23.572,39.58c28.5,9.837,49.828,39.002,52.724,74.42 H200V-0.5Z" fill="#c5c5c5"></path><path d="M121.178,125.08c14.039-7.617,23.572-22.485,23.572-39.58c0-24.853-20.147-45-45-45 c-24.854,0-45,20.147-45,45c0,17.174,9.622,32.096,23.768,39.681c-28.349,9.938-49.534,39.026-52.419,74.319h147.803 C171.006,164.082,149.678,134.917,121.178,125.08Z" fill="#ffffff"></path></svg>');
}

\Hook::set('page.avatar', __NAMESPACE__ . "\\avatar", 0);