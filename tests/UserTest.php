<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

use App\Models\User\User;

class UserTest extends TestCase
{

    use DatabaseTransactions;

    /** @test */
    public function show_login_form()
    {
        $this->visit('/login')
            ->see('Se connecter');
    }

    /** @test */
    public function user_can_login()
    {
        $user = factory(App\Models\User\User::class)->create([
            'email' => 'test@starter.kit',
            'password' => 'starterkit',
            'role' => 'administrator'
        ]);

        $this->visit('/login')
            ->type('test@starter.kit', 'email')
            ->type('starterkit', 'password')
            ->press('login')
            ->see('/home');
    }

    /** @test */
    public function user_can_register()
    {
        $this->visit('/register')
            ->type('Othmane', 'name')
            ->type('test@starter.kit', 'email')
            ->type('starterkit', 'password')
            ->type('starterkit', 'password_confirmation')
            ->press('Register')
            ->seePageIs('/home');
    }

    /** @test */
    public function user_can_be_admin()
    {
        // Unauthorized
        $this->visit(route('admin.users.index'))
            ->seePageIs('/connexion');

        $admin = factory(App\Models\User\User::class)->create([
            'email' => 'admin@starter.kit',
            'password' => 'starterkit',
            'role' => 'administrator'
        ]);

        $this->actingAs($admin)
            ->visit(route('admin.users.index'))
            ->see("utilisateurs");
    }

    /** @test */
    public function user_can_be_moderator()
    {
        // Unauthorized
        $this->visit(route('admin.index'))
            ->seePageIs('/connexion');

        $moderator = factory(App\Models\User\User::class)->create([
            'name' => 'Moderator',
            'email' => 'moderator@starter.kit',
            'password' => 'starterkit',
            'role' => 'moderator'
        ]);

        $this->actingAs($moderator)
            ->visit(route('admin.index'))
            ->see("Admin pages");
    }

    /** @test */
    public function user_can_be_created()
    {
        $admin = factory(App\Models\User\User::class)->create([
            'email' => 'admin@starter.kit',
            'password' => 'starterkit',
            'role' => 'administrator'
        ]);

        $this->actingAs($admin)
            ->visit('/admin/users/create')
            ->type('Othmane', 'name')
            ->type('test@starter.kit', 'email')
            ->type('starterkit', 'password')
            ->type('starterkit', 'password_confirmation')
            ->press('save')
            ->seePageIs('/admin/users');

        $this->assertEquals(2, User::count());
    }

    /** @test */
    public function user_can_be_stored()
    {
        $admin = factory(App\Models\User\User::class)->create([
            'email' => 'admin@starter.kit',
            'password' => 'starterkit',
            'role' => 'administrator'
        ]);

        $this->call("POST", "/admin/users", [
            "name" => "Othmane",
            "email" => "test@starter.kit",
            "role" => "user",
            "password" => "starterkit",
            "password_confirmation" => "starterkit",
        ]);

    }


    /** @test */
    public function user_can_be_edited()
    {
        $admin = factory(App\Models\User\User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@starter.kit',
            'password' => 'starterkit',
            'role' => 'administrator'
        ]);

        $user = factory(App\Models\User\User::class)->create([
            'name' => 'User',
            'email' => 'user@starter.kit',
            'password' => 'starterkit',
            'role' => 'user'
        ]);

        $this->actingAs($admin)
            ->visit('/admin/users/'.$user->id.'/edit')
            ->type('Othmane', 'name')
            ->type('test@starter.kit', 'email')
            ->press('save')
            ->seePageIs('/admin/users');

        $updated = User::find($user->id);
        $this->assertEquals("Othmane", $updated->name);
    }

    /** @test */
    public function user_can_be_updated()
    {
        $admin = factory(App\Models\User\User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@starter.kit',
            'password' => 'starterkit',
            'role' => 'administrator'
        ]);

        $user = factory(App\Models\User\User::class)->create([
            'name' => 'User',
            'email' => 'user@starter.kit',
            'password' => 'starterkit',
            'role' => 'user'
        ]);

        $this->actingAs($admin)
        ->call("PUT", "/admin/users/".$user->id, [
            "name" => "Othmane",
            "email" => "test@starter.kit",
            "role" => "user",
        ]);

        $updated = User::find($user->id);

        $this->assertEquals("Othmane", $updated->name);
    }

    /** @test */
    public function admin_can_reset_password_of_a_user()
    {
        $admin = factory(App\Models\User\User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@starter.kit',
            'password' => 'starterkit',
            'role' => 'administrator'
        ]);

        $user = factory(App\Models\User\User::class)->create([
            'name' => 'User',
            'email' => 'user@starter.kit',
            'password' => 'starterkit',
            'role' => 'user'
        ]);

        $this->actingAs($admin)
            ->visit(route('admin.users.edit', $user->id))
            ->type('newpassword', 'password')
            ->type('newpassword', 'password_confirmation')
            ->press('save_password')
            ->seePageIs(route('admin.users.edit', $user->id));

        $updated = User::find($user->id);

        $this->assertTrue(\Hash::check('newpassword', $updated->password));
    }
}
