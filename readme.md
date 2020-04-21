## Conection Ubiquiti

This package is created for GET and SET configuration, in device, is work in firmware 6 and 8, 
is config for laravel 5.7 to up.

### Instalation
`composer require jlaucho/conection-ubiquiti`

After instalation publish package, this created in `config/ConectionUbiquiti.php`
the key *password_available* your type array to posibles password.

### How usage

* Need `use jlaucho\conection_ubiquiti\Models\InformationRadio;`
* Instance example: 
    ```
  $device = new InformationRadio()
  $device->user_device = 'user';
  $device->password_device = 'password';
  ```
### Method GET.
`use jlaucho\conection_ubiquiti\Controllers\GetInformatioRadio;`
* instance `$information = new GetInformatioRadio($device, $ip)`

#### Method available

Return Name device
```
$information->getDeviceName(): string
```
Return MAC device
```
$information->getDeviceMAC(): string
```
Return Model device
```
$information->getDeviceModel(): string
```
Return boolean if eth0 is activate
```
$information->getInterfaceEth0Up(): bool
```
Return Mode configuration device, example router, bridge
```
$information->getModeRadio(): string
```
```
public function getSystem(): string
{
    return $this->system;
}
```
Return speed download in kbps, if tshaper interface eth0 is active
```
$information->getRateDownKbps(): int
```
    public function getRateUpKbps(): int
    {
        if( !$this->tshaperActive()){
            return -1;
        }
        return $this->rateUpKbps();
    }

    public function getNumberConections()
    {
        return $this->numberConections();
    }

    public function getTimeUp(): string
    {
        return $this->timeUp();
    }

    public function getIfconfig(): string
    {
        return $this->ifconfig;
    }

    public function getTshaperActive() {
        return $this->tshaperActive();
    }

    public function getSSID() {
        return $this->ssid();
    }

    public function getSignal(): int {
        return $this->signal();
    }

    public function getCCQ() {
        return $this->CCQ();
    }

    public function getFrequency() {
        return $this->frequency();
    }

    public function getFirmwareVersion() {
        return $this->firmwareVersion();
    }

    public function getChannelBandwidth() {
        return $this->channelBandwidth();
    }

    public function getLanConection (): bool {
        return $this->lanConection();
    }

    public function getBaseVersionFirmware (): string {
        return $this->baseVersionFirmware();
    }

    public function getWirelessChannelList (): array {
        return $this->wireleesChannelList();
    }

    public function getWireleesChannelStatus() {
        return $this->wireleesChannelStatus();
    }

