<?php

namespace App\Http\Controllers\Admin;

use App\Tools\ImageUploader;
use Illuminate\Http\Request;

class UploadController extends ApiController
{
    /**
     * 图片上传
     *
     * @param Request $request
     * @param ImageUploader $uploader
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function image(Request $request, ImageUploader $uploader)
    {
        $this->validate($request, ['image' => 'required|image']);

        $image = $request->file('image');
        $path  = $image->isValid() ? $uploader->save($image) : '';

        return $this->success(['path' => $path]);
    }
}