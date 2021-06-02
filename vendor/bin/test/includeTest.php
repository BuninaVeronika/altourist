<?
require_once __DIR__ . '../CreatorTask.php';

class includeTest extends \PHPUnit\Framework\TestCase {

public function CreatorTask() {
$CreatorTask = new CreatorTask();
$this->assertSame( '<input type="text">', $CreatorTask->CreatorTask("text") );
}
}