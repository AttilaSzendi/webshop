<?php

namespace Modules\Authorization\Role\Enum;

use Modules\Core\Enum\AbstractEnum;

class RoleEnum extends AbstractEnum {
    public const ROLE_ADMIN              = 'admin';
    public const ROLE_DEVELOPER          = 'developer';
    public const ROLE_CONTRIBUTOR        = 'contributor';
    public const ROLE_EDITOR             = 'editor';
    public const ROLE_REGISTERED         = 'registered';
    public const ROLE_WHOREHOUSE_MANAGER = 'whorehouse_manager';
    public const ROLE_VIP                = 'vip';
    public const ROLE_COMPANY_MANAGER    = 'company_manager';
}
