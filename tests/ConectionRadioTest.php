<?php

namespace jlaucho\conection_ubiquiti\Test;

use jlaucho\conection_ubiquiti\Controllers\GetInformatioRadio;
use jlaucho\conection_ubiquiti\Models\InformationRadio;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\{RefreshDatabase, DatabaseTransactions};

class ConectionRadioTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    private $IP = '10.255.255.213';

    public function test_radio_error_comunication()
    {
        $radio = new InformationRadio();
        $radio->user_device = 'admin';
        $radio->password_device = 'g@nc0MCBO!';


        $IP = '10.255.255.13';

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertFalse($response->status_device_conection[0]);
        $this->assertContains('Error de comunicacion con el equipo', $response->status_device_conection[1]);
    }

    public function test_radio_error_auth()
    {
        $radio = new InformationRadio();
        $radio->user_device = 'admi';
        $radio->password_device = 'g@nc0MCBO!';


        $IP = '192.168.254.169';

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertFalse($response->status_device_conection[0]);
        $this->assertContains('Error de autenticacion,', $response->status_device_conection[1]);
    }
}
