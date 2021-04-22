<?php
class imagediff
    {
        private $image1;
        private $image2;
        
        function  __construct($img1, $img2)
        {
            $this->image1['path'] = realpath($img1);
            $this->image2['path'] = realpath($img2);
            if($this->image1['path'] === false || $this->image2['path'] === false)
            {
                throw new Exception('Image "'.htmlspecialchars( $this->image1 ? $img2 : $img1 ).'" not found!');
            }
            else
            {
                $this->image1['type'] = $this->imagetyte($this->image1['path']);
                $this->image2['type'] = $this->imagetyte($this->image2['path']);
            }
        }

        private function imagetyte($imgname)
        {
            $file_info = pathinfo($imgname);
            if(!empty ($file_info['extension']))
            {
                $filetype = strtolower($file_info['extension']);
                $filetype = $filetype == 'jpg' ? 'jpeg' : $filetype;
                $func = 'imagecreatefrom' . $filetype;
                if(function_exists($func))
                {
                    return $filetype;
                }
                else
                {
                    throw new Exception('File type "'.htmlspecialchars( $filetype ).'" not supported!');
                }
            }
            else
            {
                throw new Exception('File type not supported!');
            }
        }

        private function imagehex($image)
        {
            $size = getimagesize($image['path']);
            $func = 'imagecreatefrom'.$image['type'];
            $imageres = $func($image['path']);
            $zone = imagecreate(10, 10);
            imagecopyresized($zone, $imageres, 0, 0, 0, 0, 10, 10, $size[0], $size[1]);
            $colormap = array();
            $average = 0;
            $result = array();
            for($x=0; $x<10; $x++)
            {
                for($y=0; $y<10; $y++)
                {
                    $color = imagecolorat($zone, $x, $y);
                    $color = imagecolorsforindex($zone, $color);
                    $colormap[$x][$y]= 0.212671 * $color['red'] + 0.715160 * $color['green'] + 0.072169 * $color['blue'];
                    $average += $colormap[$x][$y];
                }
            }
            $average /= 400;
            for($x=0; $x<10; $x++)
            {
                for($y=0; $y<10; $y++)
                {
                    $result[]=($x<10?$x:chr($x+97)) . ($y<10?$y:chr($y+97)) . round(2*$colormap[$x][$y]/$average);
                }
            }
            return $result;
        }

        public function diff()
        {
            $hex1 = $this->imagehex($this->image1);
            $hex2 = $this->imagehex($this->image2);
            $result = 0;
            foreach($hex1 as $bit)
            {
                if(in_array($bit, $hex2))
                {
                    $result++;
                }
            }
            return $result / ( ( count($hex1) + count($hex2) ) / 2 );
        }
    }

     $imge1=$_FILES["file1"]["name"];
    $tmppathimge1=$_FILES["file1"]["tmp_name"];
move_uploaded_file($tmppathimge1, $imge1);

//уменьшить на js разрешение
    $imge2=$_FILES["file2"]["name"];
    $tmppathimge2=$_FILES["file2"]["tmp_name"];
move_uploaded_file($tmppathimge2, $imge2);

    $diff = new imagediff($imge1,  $imge2);
    print ($diff->diff() * 100 ).'%';
