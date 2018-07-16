<?php

namespace App\Http\Controllers\Admin;

use App\Models\About;
use App\Http\Resources\AboutResource;
use App\Http\Requests\UpdateAboutPost;

class AboutController extends ApiController
{
    /**
     * 查看简介
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $about = new AboutResource(About::findOrFail($id));

        return $this->success($about);
    }

    /**
     * 更新简介
     *
     * @param UpdateAboutPost $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateAboutPost $request, $id)
    {
        $about = About::findOrFail($id);
        $about->update($request->all());

        return $this->updated();
    }
}
