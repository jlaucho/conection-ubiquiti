<?php

namespace jlaucho\conection_ubiquiti;

use jlaucho\conection_ubiquiti\Models\InformationRadio;

interface InformationRadioInterface
{
    public function getConection(InformationRadio $radio);
}
