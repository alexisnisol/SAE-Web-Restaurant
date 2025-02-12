<?php
namespace App\Controllers\Auth\Users;

enum Role:string {
    case CLIENT = 'CLIENT';
    case MODERATOR = 'MODERATOR';
    case ADMIN = 'ADMIN';

    public static function valueOf(string $role): Role
    {
        return Role::tryFromString($role) ?? Role::CLIENT;
    }

    private static function tryFromString(string $role): ?Role {
        return array_find(Role::cases(), fn($case) => $case->value === $role);
    }
}
?>