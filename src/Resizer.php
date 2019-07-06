<?php
    namespace Resizer;

    use \Gumlet\ImageResize;

    class Resizer 
    {
        public function run()
        {
            $sizesArray = [
                30,50,100,200,300,400
            ];
            $path = 'test/';
            $fileList = scandir(ROOT . $path);
            unset($fileList[0]);
            unset($fileList[1]);
            foreach($fileList as $pic){
                foreach($sizesArray as $size){
                    if (!file_exists(ROOT . 'results/' . $size)) {
                        mkdir(ROOT . 'results/' . $size, 0765);
                    }
                    $image = new ImageResize($path . $pic);
                    $image->crop($size, $size, true, ImageResize::CROPCENTER);
                    $image->addFilter(function ($imageDesc) {
                        imagefilter($imageDesc, IMG_FILTER_PIXELATE,3,true);
                    });
                    $image->save( 'results/'.$size . '/' . $pic . '_'. $size .'.jpg');                  
                    
                }
                               
            }
        }
    }

?>