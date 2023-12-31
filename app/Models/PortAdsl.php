<?php

namespace App\Models;

use KartsNMS\Interfaces\Models\Keyable;

class PortAdsl extends PortRelatedModel implements Keyable
{
    protected $table = 'ports_adsl';
    protected $primaryKey = 'port_id';
    public $timestamps = false;
    protected $fillable = [
        'port_id',
        'adslLineCoding',
        'adslLineType',
        'adslAtucInvVendorID',
        'adslAtucInvVersionNumber',
        'adslAtucCurrSnrMgn',
        'adslAtucCurrAtn',
        'adslAtucCurrOutputPwr',
        'adslAtucCurrAttainableRate',
        'adslAtucChanCurrTxRate',
        'adslAturInvSerialNumber',
        'adslAturInvVendorID',
        'adslAturInvVersionNumber',
        'adslAturChanCurrTxRate',
        'adslAturCurrSnrMgn',
        'adslAturCurrAtn',
        'adslAturCurrOutputPwr',
        'adslAturCurrAttainableRate',
    ];

    /**
     * @inheritDoc
     */
    public function getCompositeKey()
    {
        return $this->port_id;
    }
}
