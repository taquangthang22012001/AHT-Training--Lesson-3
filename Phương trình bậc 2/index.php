<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phương trình bậc hai</title>
</head>
<form method="post">
        Enter a, b, c:<br>
        <input type="number" name="a" step="any" required>
        <input type="number" name="b" step="any" required>
        <input type="number" name="c" step="any" required><br><br>
        <input type="submit" value="Solve">
    </form>
<body>
    
</body>
</html>
<?php
class QuadraticEquation {
    private $a;
    private $b;
    private $c;

    public function __construct($a, $b, $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function getA() {
        return $this->a;
    }

    public function getB() {
        return $this->b;
    }

    public function getC() {
        return $this->c;
    }

    public function getDiscriminant() {
        return ($this->b * $this->b) - (4 * $this->a * $this->c);
    }

    public function getRoot1() {
        if ($this->getDiscriminant() >= 0) {
            return (-$this->b + sqrt($this->getDiscriminant())) / (2 * $this->a);
        }
        return null;
    }

    public function getRoot2() {
        if ($this->getDiscriminant() >= 0) {
            return (-$this->b - sqrt($this->getDiscriminant())) / (2 * $this->a);
        }
        return null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $a = $_POST["a"];
    $b = $_POST["b"];
    $c = $_POST["c"];

    $equation = new QuadraticEquation($a, $b, $c);
    $discriminant = $equation->getDiscriminant();

    if ($discriminant > 0) {
        $root1 = $equation->getRoot1();
        $root2 = $equation->getRoot2();
        echo "The equation has two roots: " . $root1 . " and " . $root2;
    } elseif ($discriminant == 0) {
        $root1 = $equation->getRoot1();
        echo "The equation has one root: " . $root1;
    } else {
        echo "The equation has no real roots";
    }
}
?>

