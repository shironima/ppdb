<?php

namespace App\Enums;

enum EnumPendaftaran : string
{
    case Submitted = 'Submitted';
    case RequiresRevision = 'Requires Revision';
    case Updated = 'Updated';
    case Verified = 'Verified';
    case InProgress = 'In Progress';
}
