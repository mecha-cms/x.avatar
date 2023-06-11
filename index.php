<?php namespace x\avatar;

function page__avatar($avatar, array $lot = []) {
    if (!$avatar || !\is_string($avatar)) {
        $size = \ceil(\array_shift($lot) ?: 80);
        return 'data:image/svg+xml;base64,' . \base64_encode('<svg height="' . $size . '" version="1.1" viewBox="0 0 200 200" width="' . $size . '" xmlns="http://www.w3.org/2000/svg"><path d="M0,0H200V200H0Z" fill="#' . \substr(\md5($this['author'] ?? ""), 0, 6) . '"></path><path d="M121.178 125.08C135.217 117.463 144.75 102.595 144.75 85.5 144.75 60.647 124.603 40.5 99.75 40.5 74.896 40.5 54.75 60.647 54.75 85.5 54.75 102.674 64.372 117.596 78.518 125.181 50.169 135.119 28.984 164.207 26 200H173.902C171.006 164.082 149.678 134.917 121.178 125.08Z" fill="#fff"></path></svg>');
    }
    \extract($GLOBALS, \EXTR_SKIP);
    if (!\class_exists("\\Image") || !$lot) {
        return $avatar;
    }
    // Ignore external avatar(s)
    if (false !== \strpos($avatar, '://') || 0 === \strpos($avatar, '//') || 0 !== \strpos($avatar, '/')) {
        return $avatar;
    }
    // Process local avatar(s)
    $w = \ceil(\array_shift($lot) ?: 80);
    $h = \ceil(\array_shift($lot) ?: $w);
    $q = \ceil(\array_shift($lot) ?: -1);
    $x = \pathinfo($avatar, \PATHINFO_EXTENSION) ?: 'jpg';
    $path = \To::path(\long($avatar));
    $store = \LOT . \D . 'image' . \D . 't' . \D . 'avatar' . \D . $w . ($h !== $w ? \D . $h : "") . \D . \dechex(\crc32($avatar . $q)) . '.' . $x;
    if (\function_exists("\\x\\image\\from\\" . $x)) {
        $blob = new \Image(\is_file($path) ? $path : $avatar);
        // `$page->avatar($width, $height, $quality)`
        $blob->crop($w, $h)->blob($store, $q); // Generate avatar cache
        $avatar = \To::URL($store); // Return the avatar cache URL
        // Convert direct avatar URL from folder `.\lot\image` to its proxy image URL
        $avatar = \substr_replace($avatar, $url . '/' . \trim($state->x->image->route ?? 'image', '/') . '/', 0, \strlen($url . '/lot/image/'));
    }
    return $avatar;
}

\Hook::set('page.avatar', __NAMESPACE__ . "\\page__avatar", 2);