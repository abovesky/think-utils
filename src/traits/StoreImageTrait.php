<?php

namespace abovesky\utils\traits;

use Illuminate\Http\Request;

trait StoreImageTrait
{
    public function verifyAndStoreImage($fieldname = 'image', $directory = 'unknown')
    {
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file($fieldname);
        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move('../uploads');
        if ($info) {
            // 成功上传后 获取上传信息
            // 输出 jpg
            echo $info->getExtension();
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getSaveName();
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getFilename();
        } else {
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
}
