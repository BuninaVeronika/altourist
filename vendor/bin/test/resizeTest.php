<?
require_once __DIR__ . '../resize.php';

class resizeTest extends \PHPUnit\Framework\TestCase {

    public function load() {
        $SimpleImage = new SimpleImage();
        $this->assertSame('php.jpg',$SimpleImage->load('php.jpg'));
    }
    public function save() {
        $SimpleImage = new SimpleImage('php.jpg','jpg');
        $this->assertSame('php.jpg',$SimpleImage->save('php.jpg') );
    }
    public function output() {
        $SimpleImage = new SimpleImage('php.jpg','jpg');
        $this->assertSame('jpg',$SimpleImage->output(jpg) );
    }
    public function getWidth() {
        $SimpleImage = new SimpleImage('php.jpg','jpg');
        $this->assertSame('350',$SimpleImage->getWidth(350) );
    }
    public function getHeight() {
        $SimpleImage = new SimpleImage('php.jpg','jpg');
        $this->assertSame('240',$SimpleImage->getHeight(240) );
    }
    public function resizeToHeight() {
        $SimpleImage = new SimpleImage('php.jpg','jpg');
        $this->assertSame('150,120',$SimpleImage->resizeToHeight(240) );
    }
    public function resizeToWidth() {
        $SimpleImage = new SimpleImage('php.jpg','jpg');
        $this->assertSame('150,120',$SimpleImage->resizeToWidth(350) );
    }
    public function scale() {
        $SimpleImage = new SimpleImage('php.jpg','jpg');
        $this->assertSame('320,220',$SimpleImage->scale(0.90) );
    }
    public function resize() {
        $SimpleImage = new SimpleImage('php.jpg','jpg');
        $this->assertSame('php.jpg',$SimpleImage->resize(350,240) );
    }
}