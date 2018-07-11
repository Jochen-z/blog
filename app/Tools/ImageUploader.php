<?php

namespace App\Tools;

use Symfony\Component\HttpFoundation\File\UploadedFile;

class ImageUploader
{
    protected $extension = ['png', 'jpg', 'jpeg', 'gif'];

    /**
     * 保存上传图片到本地
     *
     * @param UploadedFile $file
     * @param string $root
     * @return string
     */
    public function save(UploadedFile $file, $root = 'images')
    {
        // 文件后缀检验
        $extension = strtolower($file->getClientOriginalExtension());
        if (! in_array($extension, $this->extension)) {
            return '';
        }

        // 文件存储路径，值如：/var/www/blog/storage/app/public/avatars/201709/21/
        $folderName = $root. '/' . date('Y') . '/'. date('m') . '/' . date('d') . '/';
        $uploadPath = storage_path('app/public') . '/' . $folderName;

        // 文件名，值如：EO3VWOuIkB9935Ij.png
        $filename = str_random(16) . '.' . $extension;

        // 将图片移动到目标存储路径中
        $file->move($uploadPath, $filename);

        return config('app.url') . "/storage/$folderName$filename";
    }
}