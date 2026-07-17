<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Auth\App\Models\Group;
use Modules\Auth\App\Models\Menu;
use Modules\Auth\App\Models\Permission;
use Modules\Auth\App\Models\User;
use Tests\TestCase;

class IndependentMenuPermissionTest extends TestCase
{
    use DatabaseTransactions;

    public function test_same_permission_is_toggled_independently_for_each_menu(): void
    {
        $this->withoutMiddleware();

        $group = Group::create(['name' => 'test group', 'is_active' => true]);
        $permission = Permission::create([
            'name' => 'shared permission',
            'controller' => 'TestController',
            'action' => 'show',
        ]);
        $listMenu = Menu::create(['title' => 'list', 'order' => 1, 'is_active' => true]);
        $myListMenu = Menu::create(['title' => 'my list', 'order' => 2, 'is_active' => true]);

        $listMenu->permissions()->attach($permission->id);
        $myListMenu->permissions()->attach($permission->id);

        $this->postJson(route('group.togglePermission'), [
            'group_id' => $group->id,
            'menu_id' => $myListMenu->id,
            'permission_id' => $permission->id,
        ])->assertOk()->assertJson(['hasPermission' => true]);

        $this->assertDatabaseHas('group_menu_has_permissions', [
            'group_id' => $group->id,
            'menu_id' => $myListMenu->id,
            'permission_id' => $permission->id,
        ]);
        $this->assertDatabaseMissing('group_menu_has_permissions', [
            'group_id' => $group->id,
            'menu_id' => $listMenu->id,
            'permission_id' => $permission->id,
        ]);
        $this->assertDatabaseHas('group_has_permissions', [
            'group_id' => $group->id,
            'permission_id' => $permission->id,
        ]);
    }

    public function test_parent_menu_is_visible_when_an_accessible_child_exists(): void
    {
        $group = Group::create(['name' => 'menu group', 'is_active' => true]);
        $user = User::create([
            'first_name' => 'Menu',
            'last_name' => 'Tester',
            'mobile' => '09000000000',
            'password' => bcrypt('password'),
        ]);
        $user->groups()->attach($group->id);
        Auth::login($user->fresh());

        $permission = Permission::create([
            'name' => 'view menu',
            'controller' => 'MenuTestController',
            'action' => 'index',
        ]);
        $parent = Menu::create([
            'title' => 'parent', 'order' => 1, 'is_active' => true, 'type' => 'slider',
        ]);
        $child = Menu::create([
            'title' => 'child', 'parent_id' => $parent->id, 'order' => 1, 'is_active' => true,
        ]);

        DB::table('group_menu_has_permissions')->insert([
            'group_id' => $group->id,
            'menu_id' => $child->id,
            'permission_id' => $permission->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $menus = $user->menus('slider');

        $this->assertTrue($menus->contains('id', $parent->id));
        $this->assertTrue($menus->firstWhere('id', $parent->id)->children->contains('id', $child->id));
    }
}
