<?php

namespace DanielCosta\Dreamhost\Enum;

use MyCLabs\Enum\Enum;

/**
 * Class User Type
 *
 * @package DanielCosta\Dreamhost\Enum
 * @author  Daniel Costa
 */
class UserType extends Enum
{
    const FTP = 'ftp';
    const SFTP = 'sftp';
    const SHELL = 'shell';
}