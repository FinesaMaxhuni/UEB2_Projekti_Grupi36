<?php
class MenaxheriProdukteve {

    public static function cmimiMesatar($produktet) {
        $shuma = 0;

        foreach ($produktet as $produkti) {
            $shuma += $produkti->getCmimi();
        }

        return $shuma / count($produktet);
    }

    public static function produktiMeILire($produktet) {
        $meILire = $produktet[0];

        foreach ($produktet as $produkti) {
            if ($produkti->getCmimi() < $meILire->getCmimi()) {
                $meILire = $produkti;
            }
        }

        return $meILire;
    }

    public static function produktiMeIShtrenjte($produktet) {
        $meIShtrenjte = $produktet[0];

        foreach ($produktet as $produkti) {
            if ($produkti->getCmimi() > $meIShtrenjte->getCmimi()) {
                $meIShtrenjte = $produkti;
            }
        }

        return $meIShtrenjte;
    }
}
?>