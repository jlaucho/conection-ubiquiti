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
  ```
  this password recover, config file `App\Config\ConectionUbiquiti.php`, this key `password_available`
### Method for recover information (GET).
`use jlaucho\conection_ubiquiti\Controllers\GetInformatioRadio;`
* instance `$information = new GetInformatioRadio($device, $ip)`

#### Method GET available

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
Return Mode configuration device, example: router, bridge
```
$information->getModeRadio(): string
```
Return configuration system.cfg
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
Return speed up in kbps, if tshaper interface eth0 is active
```
$information->getRateUpKbps(): int
```
Return simultaneous connections at the moment
```
    $information->getNumberConections(): int
```
Return time up device in seconds
```
    $information->getTimeUp(): string
```
Return ifconfig device
```
    $information->getIfconfig(): string
``` 
  Return Tshaper active (booblean)
``` 
    $information->getTshaperActive(): bool
```
Return SSID device
```
    $information->getSSID(): string
```

Return signal work device
```
    $information->getSignal(): int
```
Return CCQ device
```
    $information->getCCQ()
```    
Return Frequency device
```
    $information->getFrequency(): int
```
Return version Firmware device
```
    $information->getFirmwareVersion() 
```
Return the band the device works
```
    $information->getChannelBandwidth(): int
```
Return if other device conect on lan conection this (boolean)
```
    $information->getLanConection(): bool 
```
Return base version example: V8, V6
```
    $information->getBaseVersionFirmware (): string 
```   
Return list wireless channel available (array)
```
    $information->getWirelessChannelList (): array 
```   
Return status wireles channel (boolean) 
```
    public function getWireleesChannelStatus(): bool
```