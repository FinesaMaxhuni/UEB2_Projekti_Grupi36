<?php
class Produkti {
    private $emri;
    private $cmimi;
    private $foto;

    public function __construct($emri, $cmimi, $foto) {
        $this->emri = $emri;
        $this->cmimi = $cmimi;
        $this->foto = $foto;
    }

    public function getEmri() {
        return $this->emri;
    }

    public function getCmimi() {
        return $this->cmimi;
    }

    public function getFoto() {
        return $this->foto;
    }

    public function setCmimi($cmimi) {
        if ($cmimi > 0) {
            $this->cmimi = $cmimi;
        }
    }
}
?>