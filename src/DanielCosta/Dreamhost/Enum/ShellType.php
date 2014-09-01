<?php

namespace DanielCosta\Dreamhost\Enum;

use MyCLabs\Enum\Enum;

/**
 * Class Shell Type
 *
 * @package DanielCosta\Dreamhost\Enum
 * @author  Daniel Costa
 */
class ShellType extends Enum
{
    const BASH = 'bash';
    const TCSH = 'tcsh';
    const KSH = 'ksh';
    const ZSH = 'zsh';
}