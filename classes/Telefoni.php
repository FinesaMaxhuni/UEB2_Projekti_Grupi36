<?php
require_once __DIR__ . '/Produkti.php';

class Telefoni extends Produkti {
    private $marka;

    public function __construct($emri, $cmimi, $foto, $marka) {
        parent::__construct($emri, $cmimi, $foto);
        $this->marka = $marka;
    }

    public function getMarka() {
        return $this->marka;
    }
}
?>