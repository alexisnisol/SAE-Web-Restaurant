<?php
namespace App\Controllers\Auth\Users;

enum Role:string {
    case CLIENT = 'CLIENT';
    case MODERATOR = 'MODERATEUR';
    case ADMIN = 'ADMIN';

    public static function valueOf(string $role): Role
    {
        return Role::tryFromString($role) ?? Role::CLIENT;
    }

    private static function tryFromString(string $role): ?Role {
        switch ($role) {
            case self::CLIENT->value:
                return self::CLIENT;
            case self::MODERATOR->value:
                return self::MODERATOR;
            case self::ADMIN->value:
                return self::ADMIN;
            default:
                return self::CLIENT;
        }
        // return array_find(Role::cases(), fn($case) => $case->value === $role);
    }
}
?>