<?php

namespace jlaucho\conection_ubiquiti\Test;

use jlaucho\conection_ubiquiti\Controllers\GetInformatioRadio;
use jlaucho\conection_ubiquiti\Models\InformationRadio;
use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\{RefreshDatabase, DatabaseTransactions};

class GetInformationRadioTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic test example.
     *
     * @return void
     */

    private $IP = '192.168.254.169';

    public function test_radio_information()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertTrue(strpos($response->getSystem(), 'telnetd') > 0, 'Error de comunicacion');
    }

    public function test_radio_get_eth0_up () {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertIsBool($response->getInterfaceEth0Up());
    }

    public function test_radio_get_status_conection(){
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertTrue(in_array($response->getStatusConection(), ['activa', 'inactiva']));

    }

    public function test_radio_get_eth0_number_interface() {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertIsNumeric($response->getNumberEth0());
    }

    //Funcion pendiente por terminar
    public function test_radio_get_mode_radio() {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0!';

        $IP = '10.3.3.87';//$this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertTrue(in_array($response->getModeRadio(), ['bridge', 'router']));
    }

    public function test_radio_get_name_radio() {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertSame('Pruebas MITSER', $response->getDeviceName());

    }

    public function test_radio_get_model_radio() {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertContains('NanoStation', $response->getDeviceModel());
        $this->assertIsNotBool($response->getDeviceModel());

    }

    public function test_radio_get_MAC() {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertRegExp('/^[a-f0-9]{2}[:-][a-f0-9]{2}[:-][a-f0-9]{2}[:-][a-f0-9]{2}[:-][a-f0-9]{2}[:-][a-f0-9]{2}$/i', $response->getDeviceMAC());
        $this->assertIsNotBool($response->getDeviceMAC());

    }

    public function test_radio_system () {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertContains('netconf', $response->getSystem());
        $this->assertIsNotBool($response->getSystem());

    }

    public function test_active_tshaper(){
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertTrue($response->getTshaperActive());
    }

    public function test_rate_down_kbps () {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertIsNotBool($response->getSystem());
        $this->assertIsInt($response->getRateDownKbps());

    }

    public function test_rate_up_kbps () {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertIsInt($response->getRateUpKbps());

    }

    public function test_wlan_number_conections () {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0!';

        $IP = '10.2.14.24'; //$this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertIsNumeric($response->getNumberConections());

    }

    public function test_uptime_device ()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0!';

        $IP = '10.3.3.87';

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertContains('minutos', $response->getTimeUp() );
    }

    public function test_get_tshaper_active ()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertIsBool($response->getTshaperActive() );

    }

    public function test_get_ifconfig ()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = $this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertContains('BROADCAST RUNNING', $response->getIfconfig() );
        $this->assertIsNotFloat($response->getIfconfig());
        $this->assertIsNotBool($response->getIfconfig());


    }

    public function test_get_ssid ()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0!';

        $IP = '10.3.3.87'; //$this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertContains('RING1-VANEGA', $response->getSSID() );
        $this->assertIsNotFloat($response->getIfconfig());
        $this->assertIsNotBool($response->getIfconfig());


    }

    public function test_get_signal ()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0!';

        $IP = '10.3.3.87'; //$this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertIsNotFloat($response->getIfconfig());
        $this->assertIsNotBool($response->getIfconfig());
        $this->assertIsNumeric($response->getSignal());
        $this->assertIsInt($response->getSignal());



    }

    public function test_get_CCQ ()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0!';

        $IP = '10.3.3.87'; //$this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertIsFloat($response->getCCQ());


    }

    public function test_get_frequency ()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0!';

        $IP = '10.3.3.87'; //$this->IP;


        $response = new GetInformatioRadio($radio, $IP);

        $this->assertIsInt($response->getFrequency());
        $this->assertIsNotBool($response->getFrequency());
        $this->assertIsNotArray(($response->getFrequency()));
        $this->assertIsNotIterable($response->getFrequency());

    }

    public function test_get_firmware ()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = '192.168.254.168'; //$this->IP;
//        $IP = '192.168.254.169'; //$this->IP;


        $response = new GetInformatioRadio($radio, $IP);

        $this->assertStringContainsStringIgnoringCase('v', $response->getFirmwareVersion());
        $this->assertNotNull($response->getFirmwareVersion());
        $this->assertIsNotIterable($response->getFirmwareVersion());
    }

    public function test_get_channel_bandwidth ()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0!';

        $IP = '10.3.3.87'; //$this->IP;


        $response = new GetInformatioRadio($radio, $IP);

        $this->assertIsNumeric($response->getChannelBandwidth());
        $this->assertIsInt($response->getChannelBandwidth());
        $this->assertTrue(in_array($response->getChannelBandwidth(), [10, 20, 30, 40, 60, 80, 160]));
    }

    public function test_get_lan_conection()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0!';

//        $IP = $this->IP;
        $IP = '10.3.3.87'; //$this->IP;


        $response = new GetInformatioRadio($radio, $IP);


        $this->assertIsBool($response->getLanConection());
        $this->assertIsNotInt($response->getLanConection());
        $this->assertIsNotIterable($response->getLanConection());
    }

    public function test_base_version_firmWare()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

        $IP = '192.168.254.168'; //$this->IP;
//        $IP = '192.168.254.169'; //$this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertTrue( in_array($response->getBaseVersionFirmware(), ['V8', 'V6']));
        $this->assertNotNull($response->getBaseVersionFirmware());

    }

    public function test_wireless_list_channel()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

//        $IP = '192.168.254.168'; //$this->IP;
        $IP = '192.168.254.169'; //$this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertIsArray($response->getWirelessChannelList());
        $this->assertIsIterable($response->getWirelessChannelList());
    }

    public function test_wireless_list_status()
    {
        $radio = new InformationRadio();
        $radio->user_equip = 'admin';
        $radio->password_equip = 'g@nc0MCBO!';

//        $IP = '192.168.254.168'; //$this->IP;
        $IP = '192.168.254.169'; //$this->IP;

        $response = new GetInformatioRadio($radio, $IP);

        $this->assertIsBool($response->getWireleesChannelStatus());
        $this->assertNotNull($response->getWireleesChannelStatus());

    }
}
