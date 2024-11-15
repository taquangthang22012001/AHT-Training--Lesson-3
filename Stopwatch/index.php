<?php
class StopWatch {
    private $startTime;
    private $endTime;

    public function getStartTime() {
        return $this->startTime;
    }

    public function getEndTime() {
        return $this->endTime;
    }

    public function __construct() {
        $this->startTime = microtime(true);
    }

    public function start() {
        $this->startTime = microtime(true);
    }

    public function stop() {
        $this->endTime = microtime(true);
    }

    public function getElapsedTime() {
        return ($this->endTime - $this->startTime) * 1000;
    }
}
// Sơ đồ UML
// +-------------------------+
// |        StopWatch        |
// +-------------------------+
// | - startTime:     int    |
// | - endTime:       int    |
// +-------------------------+
// | + __construct()         |
// | + start(): void         |
// | + stop():  void         |
// | + getStartTime():   int |
// | + getEndTime():     int |
// | + getElapsedTime(): int |
// +-------------------------+


// Hàm sắp xếp chọn (Selection Sort)
function selectionSort(&$array) {
    $n = count($array);
    for ($i = 0; $i < $n - 1; $i++) {
        $minIndex = $i;
        for ($j = $i + 1; $j < $n; $j++) {
            if ($array[$j] < $array[$minIndex]) {
                $minIndex = $j;
            }
        }
        // Hoán đổi phần tử nhỏ nhất với phần tử đầu tiên của danh sách chưa sắp xếp
        $temp = $array[$minIndex];
        $array[$minIndex] = $array[$i];
        $array[$i] = $temp;
    }
}

// Tạo một mảng gồm 100,000 số ngẫu nhiên
$array = [];
for ($i = 0; $i < 10000; $i++) {
    $array[] = rand(1, 10000);
}

// Tạo đối tượng StopWatch và đo thời gian sắp xếp
$stopWatch = new StopWatch();
$stopWatch->start();

selectionSort($array);

$stopWatch->stop();

echo "Thời gian thực thi của thuật toán sắp xếp chọn: " . $stopWatch->getElapsedTime() . " milliseconds";
?>
