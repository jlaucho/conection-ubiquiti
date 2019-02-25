<?php

namespace jlaucho\conection_ubiquiti;


class SetInformationRadio extends RadioController
{
    public function setStatusConection() {
        $this->statusConection();
    }

    private function statusConection()
    {
        $eth0_num = $this->numberEth0();
//        dd("sed -i -e 's#netconf." . $eth0_num . ".up=enabled#netconf." . $eth0_num . ".up=enabled#' /tmp/system.cfg");
//        if ($this->ssh->exec("sed -i -e 's#netconf." . $eth0_num . ".up=disabled#netconf." . $eth0_num . ".up=enabled#' /tmp/system.cfg"))
//        {
//            dd('cambio');
//        } else {
//
//        }
        dd($this->getStatusConection());
        $eth0_num = $this->numberEth0();
        dd($this->getSystem());
    }
}
