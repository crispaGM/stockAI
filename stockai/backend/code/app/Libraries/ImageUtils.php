<?php

namespace App\Libraries;

use Log;
use Image;

class ImageUtils
{

    /**
     * upload de imagens.
     * @param null $data
     * @param string $repositoryDir
     * @param string $fileName
     * @param string $pathOldImage
     * @return string
     */
    public static function saveImage($data, $repositoryDir, $fileName, $pathOldImage)
    {
        $arr = explode(';', $data);

        $data = str_replace('base64,', '', $arr[1]);
        $data = str_replace(' ', '+', $data);
        $data = base64_decode($data);


        $fileDir = public_path() . DIRECTORY_SEPARATOR . $repositoryDir;

        if (!file_exists($fileDir)) {
            mkdir($fileDir, 0777, true);
        }
        $fileNameBase64 = base64_encode(hash('md5', $fileName . time()));

        $image = Image::make($data);
        $mime = explode('/', $image->mime());

        $format   = $mime[1];
        $extensao = '.' . $format;

        $filePath = $fileDir . DIRECTORY_SEPARATOR . $fileNameBase64 . $extensao;

        if ($image->getSize()->width > 800) {
            $percentualResize = 50;
            $widthResize      = ($image->getSize()->width * $percentualResize) / 100;

            $image->resize($widthResize, null, function ($constraint) {
                $constraint->aspectRatio();
            })->encode($format, 50);
        }


        $image->save($filePath);


        if ($pathOldImage) {
            if (file_exists(public_path() . '/' . $pathOldImage)) {
                chmod(public_path() . '/' . $pathOldImage, 0777);
                unlink(public_path() . '/' . $pathOldImage);
            }
        }

        return $repositoryDir . '/' . $fileNameBase64 . $extensao;
    }

    /**
     * upload de imagens com largura variavel.
     * @param null $data
     * @param string $repositoryDir
     * @param string $fileName
     * @param string $pathOldImage
     * @param int $width
     * @param int $heigth
     * @return string
     */
    public static function saveImageWithWidth($data, $repositoryDir, $fileName, $pathOldImage, $width, $heigth = null)
    {
        $arr = explode(';', $data);
        $data = str_replace('base64,', '', $arr[1]);
        $data = str_replace(' ', '+', $data);
        $data = base64_decode($data);


        $fileDir = public_path() . DIRECTORY_SEPARATOR . $repositoryDir;

        if (!file_exists($fileDir)) {
            mkdir($fileDir, 0777, true);
        }
        $fileNameBase64 = base64_encode(hash('md5', $fileName . time()));

        $image = Image::make($data);
        $mime = explode(DIRECTORY_SEPARATOR, $image->mime());

        $extensao = '.' . $mime[1];
        $filePath = $fileDir . DIRECTORY_SEPARATOR . $fileNameBase64 . $extensao;

        if ($image->mime() == 'image/png') {
            $image
                ->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('png');
        } else {
            $image
                ->resize($width, null, function ($constraint) {
                    $constraint->aspectRatio();
                })
                ->encode('jpg', 50);
        }


        $image->save($filePath);

//        $filePath = $fileDir . '/' . $fileNameBase64 . '.png';
//        file_put_contents($filePath, $data);

        if ($pathOldImage) {
            if (file_exists(public_path() . DIRECTORY_SEPARATOR . $pathOldImage)) {
                chmod(public_path() . DIRECTORY_SEPARATOR . $pathOldImage, 0777);
                unlink(public_path() . DIRECTORY_SEPARATOR . $pathOldImage);
            }
        }

        return $repositoryDir . DIRECTORY_SEPARATOR . $fileNameBase64 . $extensao;
    }


    public static function deleteImage($path)
    {
        if ($path) {
            if (file_exists(public_path() . DIRECTORY_SEPARATOR . $path)) {
                chmod(public_path() . DIRECTORY_SEPARATOR . $path, 0777);
                unlink(public_path() . DIRECTORY_SEPARATOR . $path);
            }
        }
    }
}
