<?php

namespace jlaucho\conection_ubiquiti;

use App\Http\Controllers\Controller;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
    public $response;

    public function __construct(InformationRadio $radio, string $IP)
    {

//        $IP = '10.3.0.1';

        $this->interface = 'eth0';
        $this->ip = $IP;

        $response['IP'] = $IP;
        // $this->getConection($radio);

//         $passwords = config('ConectionUbiquiti.password_available');

        $passwords = [

            // Contraseñas más comunes
            'g@nc0!',
            'g@nc0MCBO!',
            'g@nco!',
            'g@nc0MCBO',
            'g@nc0GB!',
            'g@ncoGB!',
            'g@nc0gb!',
            'g@ncogb!',
            'g@nc0!@1',
            'g@nco!@1',
            ];

        foreach ($passwords as $password){

            $radio->password_device = $password;

            $this->getConection($radio);

            if(!$this->status_device_conection[0] && $this->status_device_conection[2] == 'conection') {
                $response[$this->ip]['IP'] = $IP;
                $response[$this->ip]['Conection'] = false;
                $response[$this->ip]['status'] = $this->status_device_conection[1];
                $response[$this->ip]['type'] = $this->status_device_conection[2];
                $response[$this->ip]['password'] = 'S/I';
                 break;
            }

            if(!$this->status_device_conection[0] && $this->status_device_conection[2] == 'refused') {
                $response[$this->ip]['IP'] = $IP;
                $response[$this->ip]['Conection'] = false;
                $response[$this->ip]['status'] = $this->status_device_conection[1];
                $response[$this->ip]['type'] = $this->status_device_conection[2];
                $response[$this->ip]['password'] = 'S/I';
                break;
            }

            if(!$this->status_device_conection[0] && $this->status_device_conection[2] == 'password'){
                $response[$this->ip]['IP'] = $IP;
                $response[$this->ip]['Conection'] = false;
                $response[$this->ip]['status'] = $this->status_device_conection[1];
                $response[$this->ip]['type'] = $this->status_device_conection[2];
                $response[$this->ip]['password'] = 'S/I';
                continue;
            }
            if($this->status_device_conection[0]) break;
        }

        if($this->status_device_conection[0]) {
            $response[$this->ip]['IP'] = $IP;
            $response[$this->ip]['Conection'] = true;
            $response[$this->ip]['status'] = $this->status_device_conection[1];
            $response[$this->ip]['password'] = $password;
            // continue;
        }
            // if($IP == '10.3.0.9') dd($response);

        $this->response = $response;

            // $this->response = $response;
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

    private function stopFaulire($message, $type){
        $this->status_device_conection[0] = false;
        $this->status_device_conection[1] = $message;
        $this->status_device_conection[2] = $type;
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
                $this->stopFaulire("Error de autenticacion, revise credenciales", "password");
               return;
            }
        } catch (\Exception $e) {
            if(Str::contains($e->getMessage(), 'refused')){
                $this->stopFaulire("Error de comunicacion con el equipo", "refused");
                return;
            }
            $this->stopFaulire("Error de comunicacion con el equipo", "conection");
            return;
        }

        $this->status_device_conection[0] = true;
        $this->status_device_conection[1] = "Conexion establecida correctamente";

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
