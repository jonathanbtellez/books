<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		$permissionsLibrarian = [
			'books.index',
			'books.create',
			'books.store',
			'books.edit',
			'books.update',
			'books.destroy',
			'categories.index',
			'categories.create',
			'categories.store',
			'categories.edit',
			'categories.update',
			'categories.destroy',
			'authors.index',
			'authors.create',
			'authors.store',
			'authors.edit',
			'authors.update',
			'authors.destroy',
		];

		$permissionsAdmin = array_merge([
			'users.index',
			'users.create',
			'users.store',
			'users.edit',
			'users.update',
			'users.destroy',
		], $permissionsLibrarian);

		// Roles
		$admin = Role::create(['name' => 'admin']);
		$librarian = Role::create(['name' => 'librarian']);
		Role::create(['name' => 'user']);

		foreach ($permissionsAdmin as $permission) {
			$permission = Permission::create(['name' => $permission]);
			$admin->givePermissionTo($permission);
		}
		foreach ($permissionsLibrarian as $permission) {
			$permission = Permission::where(['name' => $permission])->first();
			$librarian->givePermissionTo($permission);
		}
	}
}
