<?php 

namespace app\models\admin;

class Product extends \app\models\AppModel
{
    public $attributes = [
        'category_id' => '',
        'title' => '',
        'alias' => '',
        'content' => '',
        'price' => '',
        'discount' => '',
        'keywords'=> '',
        'description' => '',
        'hit' => '',
        'release_date' => ''
    ];

    public $errors = [];

    public function valid($data)
    {
        if (mb_strlen($data['title']) < 4) $this->errors[] = 'Название должно быть не короче 4 символов';
        if (mb_strlen($data['alias']) < 4) $this->errors[] = 'Alias должен быть не короче 4 символов';
        if (mb_strlen($data['content']) < 15) $this->errors[] = 'Описание должно быть не короче 15 символов';
        if ((int)$data['price'] <= 0) $this->errors[] = 'Некорректная цена';
        if ((int)$data['discount'] < 0 || (int)$data['discount'] > 100) $this->errors[] = 'Некорректная скидка';
        if (mb_strlen($data['release_date']) < 4) $this->errors[] = 'Некорректная дата';

        if(!empty($this->errors)) return $this->errors;

        return false;
    }

    public static function resize($target, $dest, $wmax, $hmax, $ext){
        list($w_orig, $h_orig) = getimagesize($target);
        $ratio = $w_orig / $h_orig;

        if(($wmax / $hmax) > $ratio){
            $wmax = $hmax * $ratio;
        }else{
            $hmax = $wmax / $ratio;
        }

        $img = "";
        switch($ext){
            case("gif"):
                $img = imagecreatefromgif($target);
                break;
            case("png"):
                $img = imagecreatefrompng($target);
                break;
            default:
                $img = imagecreatefromjpeg($target);
        }
        $newImg = imagecreatetruecolor($wmax, $hmax);

        if($ext == "png"){
            imagesavealpha($newImg, true);
            $transPng = imagecolorallocatealpha($newImg,0,0,0,127);
            imagefill($newImg, 0, 0, $transPng);
        }

        imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig);
        switch($ext){
            case("gif"):
                imagegif($newImg, $dest);
                break;
            case("png"):
                imagepng($newImg, $dest);
                break;
            default:
                imagejpeg($newImg, $dest);
        }
        imagedestroy($newImg);
    }

}


?>