<?php

namespace App\Enums;

enum JobStatus: int
{
  case PROGRESS = 1;
  case SUCCESS = 2;
  case FAILED = 3;
}
