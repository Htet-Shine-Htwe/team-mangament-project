<?php

namespace App\Constants;

use App\Models\Status;

enum IssueStatusEnum :int
{
    case BACKLOG = Status::where('name','Backlog')->first()->id;
    case TODO = Status::where('name','Todo')->first()->id;
    case IN_PROGRESS = Status::where('name','In Progress')->first()->id;
    case Done = Status::where('name','Done')->first()->id;
    case Canceled = Status::where('name','Canceled')->first()->id;

}
