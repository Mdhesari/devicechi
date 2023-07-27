<?php

namespace Modules\Admin\Console;

use Arr;
use Hash;
use Illuminate\Console\Command;
use Modules\Admin\Entities\Admin;
use App\Models\Role;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CreateAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {email} {name=admin} {--validate_email=1} {--super_admin=1}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates new super admin user.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $data = $this->arguments();

        $admin = Admin::whereEmail($data['email'])->first();

        if ($admin) {

            if ($this->confirm('Admin AlreadExists! Do you want to delete it?!')) {

                $admin->delete();
            } else return 0;
        }

        $password = $this->secret('Enter password : ');

        $email_verified_at = boolval($this->option('validate_email')) ? now() : null;

        $admin = Admin::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($password),
            'email_verified_at' => $email_verified_at,
        ]);

        $roleName = boolval($this->option('super_admin')) ? 'super-admin' : 'admin';

        $role = $admin->assignRole($roleName);

        if ($role) $this->info("The admin user is successfully created : {$admin->name} with {$admin->email} email \nwith {$roleName} role.");
        else $this->error("Something went wrong...");
    }
}
