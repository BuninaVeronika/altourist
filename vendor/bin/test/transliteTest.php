<?
require_once __DIR__ . 'translite.php';

class transliterateTest extends \PHPUnit\Framework\TestCase {

    public function transliterate() {
        $translite = new transliterate();
        $this->assertSame( 'testirovanie', $translite->transliterate('Тестирование') );
    }
}