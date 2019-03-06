<?php

namespace jlaucho\conection_ubiquiti;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use jlaucho\conection_ubiquiti\Exception\AutenticationDeviceException;
use jlaucho\conection_ubiquiti\Models\InformationRadio;
use phpseclib\Net\SSH2;

abstract class RadioController extends Controller
{

    private $ssh;
    public $ifconfig;
    public $system;
    private $ip;
    public $interface;
    public $mca_status;
    public $status_device_conection = [];

    public function __construct(InformationRadio $radio, string $IP)
    {

        $this->interface = 'eth0';
        $this->ip = $IP;
        $this->getConection($radio);


        if(! $this->status_device_conection[0]){
//            return redirect()->back();

//
//            throw new \Exception(
//                'No Autorized',
//                404,
//                $this->redirectTo($request = null)
//            );
        }
    }

    protected function redirectTo($request)
    {
            return redirect()->back();
    }



    public function getIpConection() {
        return $this->ip;
    }

    public function getStatusConection(): string {
        return $this->statusConection();
    }

    public function getNumberEth0(){
        return $this->numberEth0();
    }

    public function getNumberAth0(){
        return $this->numberAth0();
    }

    private function stopFaulire($message){
        $this->status_device_conection[] = false;
        $this->status_device_conection[] = $message;
    }

    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo('');
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : '/home';
    }



    private function getConection(InformationRadio $radio){

        $ip = $this->ip;
        $this->ssh = new SSH2($ip);

        try {
            if (!$this->ssh->login($radio->user_device, $radio->password_device)) {
                $this->stopFaulire("Error de autenticacion, revise credenciales");
                $this->redirectPath();
//                return;
            }
        } catch (\Exception $e) {
            $this->stopFaulire("Error de comunicacion con el equipo");
            $this->redirectTo($request = null);
        }

        $this->status_device_conection[] = true;
        $this->status_device_conection[] = "Conexion establecida correctamente";

        $this->ifconfig = $this->ifconfig();
        $this->system = $this->system();
        $this->mca_status = $this->mca_status();

        $this->closeConection();
    }



    private function ifconfig()
    {
        return $this->ssh->exec('ifconfig');
    }

    private function system()
    {
        return $this->ssh->exec('cat /tmp/system.cfg');
    }

    private function closeConection()
    {
        $this->ssh->disconnect();
    }

    private function numberEth0(): int
    {
        $preg_array = array();
        if (preg_match('/^netconf(?|.{1,3}|)\.[0-9]{1,2}\.devname='.$this->interface.'$/sm', $this->system, $preg_array))
        {
            $preg_array = explode('.', $preg_array[0]);
            return $eth0_num = intval($preg_array[1]);
        }
    }

    private function numberAth0(): int
    {
        $preg_array = array();
        if (preg_match('/^netconf(?|.{1,3}|)\.[0-9]{1,2}\.devname=ath0$/sm', $this->system, $preg_array))
        {
            $preg_array = explode('.', $preg_array[0]);
            return $ath0_num = intval($preg_array[1]);
        }
    }

    /**
     * @return string
     */

    private function statusConection(): string
    {
        $eth0_num = $this->numberEth0();
        $status = strpos($this->system, 'netconf.' . $eth0_num . '.up=enabled');
        if($status){
            return 'activa';
        }
        return 'inactiva';
    }

    private function mca_status(): string
    {
        return $this->ssh->exec('mca-status');
    }

}
