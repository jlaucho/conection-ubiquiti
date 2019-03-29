<?php


namespace jlaucho\conection_ubiquiti;

class MethodGetInformation extends RadioController
{
    public function rateDownKbps (): int
    {
//        dd($this->system);
//        dd('tshaper.'.$this->getNumberEth0().'.output.rate=');
        $preg_array = array();
        if (preg_match('/^tshaper.'.$this->getNumberEth0().'.output.rate=[0-9]{2,}$/sm', $this->system, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);

            return $preg_array[1];
        }
        return -1;
    }

    public function rateUpKbps (): int
    {
        $preg_array = array();
        if (preg_match('/^tshaper.'.$this->getNumberEth0().'.input.rate=[0-9]{2,}$/sm', $this->system, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);

            return $preg_array[1];
        }
        return -1;
    }

    public function numberConections()
    {
        // Obtener CONEXIONES DEL EQUIPO
        $numberConections = '';

        if (preg_match('/wlanConnections=[^\r]*/sm', $this->mca_status, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);
            $numberConections = $preg_array[1];
        }

        return $numberConections;
    }

    public function modeRadio()
    {
        $preg_array = array();
        if(! $this->status_device_conection[0]){
            return null;
        };

        if (preg_match('/^netmode=[a-z]{3,}$/sm', $this->system, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);
            return $mode = $preg_array[1];
        }

    }

    public function deviceName()
    {
        // Obtener nombre
        $name = '';
        if (preg_match('/deviceName=[^,]*/sm', $this->mca_status, $preg_array))
        {
            //dd($preg_array);
            $preg_array = explode('=', $preg_array[0]);
            $name = $preg_array[1];
        }

        return $name;
    }

    public function deviceModel()
    {
        // Obtener modelo
        $model = '';

        if (preg_match('/platform=[^,]*/sm', $this->mca_status, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);
            $model = $preg_array[1];
        }

        return $model;
    }

    public function deviceMAC()
    {
        // Obtener MAC
        $mac = '';

        if (preg_match('/deviceId=[^,]*/sm', $this->mca_status, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);
            $mac = $preg_array[1];
        }

        return $mac;
    }

    public function interfaceEthUp()
    {
        return strpos($this->getIfconfig(), 'eth0') > 0 ? true : false;
    }

    public function tshaperActive()
    {
        try {

            $preg_array = array();
            if (preg_match('/^tshaper.status=[a-z]{3,}$/sm', $this->system, $preg_array))
            {
                $preg_array = explode('=', $preg_array[0]);

                return $preg_array[1] == 'enabled' ? 1 : 0;
            }
        } catch (\Exception $e) {
            dd($e, $preg_array);
        }
    }

    public function timeUp()
    {
        // Obtener Tiempo encendido
        $timeUp = '';

        if (preg_match('/uptime=[^\r]*/sm', $this->mca_status, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);
            $timeUp = $preg_array[1];
        }

        $dtF = new \DateTime('@0');
        //dd($dtF);

        $dtT = new \DateTime("@$timeUp");
        //dd($dtT);

        return $dtF->diff($dtT)->format('%a d&iacute;as, %h horas, %i minutos y %s segundos');

    }

    public function ssid()
    {
        // Obtener el SSID
        $ssid = '';

        if (preg_match('/essid=[^\r]*/sm', $this->mca_status, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);
            $ssid = $preg_array[1];
        }

        return $ssid;

    }

    public function signal(): int
    {
        // Obtener el Signal Strench
        $signal = '';

        if (preg_match('/signal=[^\r]*/sm', $this->mca_status, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);
            $signal = $preg_array[1];
        }

        return intval($signal);
    }

    public function CCQ()
    {
        // Obtener el CCQ
        $ccq = '';

        if (preg_match('/ccq=[^\r]*/sm', $this->mca_status, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);
            $ccq = $preg_array[1];
        }


        return (count($preg_array)) ? $ccq / 10 : 'N/A';
    }

    public function frequency()
    {
        // Obtener el frecuency
        $frequency = '';

        if (preg_match('/freq=[^\r]*/sm', $this->mca_status, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);
            $frequency = $preg_array[1];
        }

        return intval($frequency);
    }

    public function firmwareVersion()
    {
        // Obtener firmware
        $firmware = '';
        if (preg_match('/firmwareVersion=[^,]*/sm', $this->mca_status, $preg_array))
        {
            //dd($preg_array);
            $preg_array = explode('=', $preg_array[0]);
            $firmware = $preg_array[1];
        }

        return $firmware;
    }

    public function channelBandwidth()
    {
        // Obtener el Signal Strench
        $channelBandwith = '';

        if (preg_match('/chanbw=[^\r]*/sm', $this->mca_status, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);
            $channelBandwith = $preg_array[1];
        }

        return intval($channelBandwith);
    }

    public function lanConection()
    {
        // Obtener el Signal Strench
        $lan_conection = '';

        if (preg_match('/lanPlugged=[^\r]*/sm', $this->mca_status, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);
            $lan_conection = $preg_array[1];
        }

        return boolval($lan_conection);
    }

    public function baseVersionFirmware (): string {
        return strpos( $this->firmwareVersion(), 'v8') ? 'V8' : 'V6';
    }

    public function wireleesChannelStatus (): bool {
        $preg_array = array();

        $search_camp = $this->seach_camp().'.1.scan_list.status';

        if (preg_match('/^'. $search_camp .'=[^\\n]*/sm', $this->system, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);

            return $preg_array[1] == 'enabled' ? true: false;
        }
    }

    public function wireleesChannelList () {
        $preg_array = array();

        $search_camp = $this->seach_camp().'.1.scan_list.channels';

        if (preg_match('/^'. $search_camp .'=[^\\n]*/sm', $this->system, $preg_array))
        {
            $preg_array = explode('=', $preg_array[0]);

            return explode(',', $preg_array[1]);
        }
    }

    private function seach_camp () {
        if( $this->baseVersionFirmware() == 'V8' ) {
            $search_camp = 'radio';
        } else {
            $search_camp = 'wireless';
        }

        return $search_camp;
    }
}
