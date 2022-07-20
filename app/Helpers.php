<?php



if (!function_exists('uploadFileWithPath')) {
    function uploadFileWithPath($file, $dir)
    {
        if (!is_file($file))
            dd($file);

        $image = time() . uniqid() . '.' . $file->getClientOriginalExtension();
        $imageObject = $file->move('uploads' . '/' . $dir, $image);
        return $imageObject->getPathname();
    }
}
