<?php

namespace jlaucho\conection_ubiquiti\Controllers;

use jlaucho\conection_ubiquiti\MethodGetInformation;

class GetInformatioRadio extends MethodGetInformation
{

    public function getDeviceName(): string
    {
        return $this->deviceName();
    }

    public function getDeviceMAC(): string
    {
        return $this->deviceMAC();
    }

    public function getDeviceModel(): string
    {
        return $this->deviceModel();
    }

    public function getInterfaceEth0Up(){
        return $this->interfaceEthUp();
    }

    public function getModeRadio()
    {
        return $this->modeRadio();
    }

    public function getSystem(): string
    {
        return $this->system;
    }

    public function getRateDownKbps(): int
    {
        if ($this->getNumberTshaper()){

            return $this->rateDownKbps();
        }

        return -1;
    }

    public function getRateUpKbps(): int
    {
        if ($this->getNumberTshaper()){

            return $this->rateUpKbps();
        }

        return -1;
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


}
