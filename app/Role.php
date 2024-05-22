<?php

namespace App;

enum Role: int
{
    case ADMINISTRATOR = 1;
    case MANAGER = 2;
    case EMPLOYEE = 3;
}
