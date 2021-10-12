<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\UserConfirm;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Configuration;
// Main Table
use App\Models\Bank;
use App\Models\Brand;
use App\Models\Car;
use App\Models\CarPenalty;
use App\Models\Customer;
use App\Models\CustomerContact;
use App\Models\Driver;
use App\Models\Fuel;
use App\Models\Identity;
use App\Models\Model;
use App\Models\Service;
use App\Models\Status;
use App\Models\Type;


class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Ask for db migration refresh, default is no
        if ($this->command->confirm('Do you wish to refresh migration before seeding, it will clear all old data ?')) {
            // Call the php artisan migrate:refresh
            $this->command->call('migrate:refresh');
            $this->command->warn("Data cleared, starting from blank database.");
        }

        // Seed the default permissions
        $permissions = Permission::defaultPermissions();

        foreach ($permissions as $perms) {
            Permission::firstOrCreate(['name' => $perms]);
        }

        $this->command->info('Default Permissions added.');

        // Confirm roles needed
        if ($this->command->confirm('Create Roles for user, default is admin and user? [y|N]', true)) {

            // Ask for roles from input
            $input_roles = $this->command->ask('Enter roles in comma separate format.', 'Admin,User');

            // Explode roles
            $roles_array = explode(',', $input_roles);

            // add roles
            foreach ($roles_array as $role) {
                $role = Role::firstOrCreate(['name' => trim($role)]);

                if ($role->name == 'Admin') {
                    // assign all permissions
                    $role->syncPermissions(Permission::all());
                    $this->command->info('Admin granted all the permissions');
                } else {
                    // for others by default only read access
                    $role->syncPermissions(Permission::where('name', 'LIKE', 'view_%')->get());
                }

                // create one user for each role
                $this->createUser($role);
            }

            $this->command->info('Roles ' . $input_roles . ' added successfully');
        } else {
            Role::firstOrCreate(['name' => 'User']);
            $this->command->info('Added only default user role.');
        }

        $roleUser = Role::where("name", trim("User"))->first();
        for ($i = 1; $i <= 100; $i++) {
            $this->createUser($roleUser);
        }

        // now lets seed some posts for demo
        $this->createData();
        $this->createConfig();
        $this->command->info('Some data seeded.');
        $this->command->warn('All done :)');
    }

    /**
     * Create a user with given role
     *
     * @param $role
     */
    private function createUser($role) {
        $user = factory(User::class)->create();
        $user->assignRole($role->name);

        if ($role->name == 'Admin') {
            $_user = User::where("id", $user->id)->first();
            $_user->email = "admin@admin.com";
            $_user->username = "admin";
            $_user->save();
            $this->command->info('Here is your admin details to login:');
            $this->command->warn($_user->username);
            $this->command->warn('Password is "secret"');
        }

        UserConfirm::create([
            'user_id' => $user->id,
            'token' => base64_encode($user->email)
        ]);
    }

    private function createData(){
        for($i = 1; $i <= 25; $i++){

            $faker = Faker::create();

            $bank = Bank::create([
                "code"=> rand(1000,9999),
                "name"=> $faker->sentence,
                "description"=> $faker->text,
            ]);

            $brand = Brand::create([
                "name"=> $faker->sentence,
                "description"=> $faker->text,
            ]);   

            $identity = Identity::create([
                "name"=> $faker->sentence,
                "description"=> $faker->text,
            ]);   

            $fuel = Fuel::create([
                "name"=> $faker->sentence,
                "description"=> $faker->text,
            ]);  

            $model = Model::create([
                "name"=> $faker->sentence,
                "description"=> $faker->text,
            ]);  

            $status = Status::create([
                "name"=> $faker->sentence,
                "description"=> $faker->text,
            ]);  

            $type = Type::create([
                "name"=> $faker->sentence,
                "description"=> $faker->text,
            ]); 

            $service = Service::create([
                "name"=> $faker->sentence,
                "charge"=> rand(1000,9999),
                "description"=> $faker->text,
            ]);  
            
            $customer = Customer::create([
                'identity_id'=> $identity->id,
                'id_number'=> rand(1000,9999).".".rand(1000,9999),
                'code'=> "CS.".date("Ymd").".".rand(1000,9999).".".time(),
                'name'=> $faker->name,
                'gender'=> rand(1,2),
                'email'=> $faker->unique()->safeEmail,
                'phone'=> $faker->phoneNumber,
                'mobile'=> $faker->phoneNumber,
                'postal_code'=>$faker->creditCardNumber,
                'fax_number'=>$faker->creditCardNumber,
                'address'=>$faker->address,
                'notes'=> $faker->text,
                'is_banned'=> 0,
            ]); 

            for($j = 1; $j <=5; $j++){
                CustomerContact::create([
                    'customer_id'=> $customer->id,
                    'name'=> $faker->name,
                    'gender'=> rand(1,2),
                    'email'=> $faker->unique()->safeEmail,
                    'phone'=> $faker->phoneNumber,
                    'mobile'=> $faker->phoneNumber,
                    'postal_code'=>$faker->creditCardNumber,
                    'fax_number'=>$faker->creditCardNumber,
                    'address'=>$faker->address,
                ]);
            }

            $driver = Driver::create([
                'identity_id'=> $identity->id,
                'id_number'=> rand(1000,9999).".".rand(1000,9999),
                'code'=> "DV.".date("Ymd").".".rand(1000,9999).".".time(),
                'name'=> $faker->name,
                'gender'=> rand(1,2),
                'email'=> $faker->unique()->safeEmail,
                'phone'=> $faker->phoneNumber,
                'mobile'=> $faker->phoneNumber,
                'postal_code'=>$faker->creditCardNumber,
                'fax_number'=>$faker->creditCardNumber,
                'address'=>$faker->address,
                'notes'=> $faker->text,
                'is_ready'=> 1,
            ]); 

            $colors = ["black","white","red","blue","yellow","silver"];

            $car = Car::create([
                'brand_id'=> $brand->id,
                'model_id'=> $model->id,
                'status_id'=> $status->id,
                'type_id'=> $type->id,
                'fuel_id'=> $fuel->id,
                'color'=> strtoupper($colors[rand(0, count($colors) - 1)]),
                'id_number'=> rand(1000,9999).".".rand(1000,9999),
                'year_established'=> rand(1999,(int)date("Y")),
                'length'=> rand(100,999),
                'width'=> rand(100,999),
                'height'=> rand(100,999),
                'capacity'=> rand(2, 10),
                'charge'=> rand(1000,9999),
                'description'=> $faker->text,
                'notes'=> $faker->text,
                'is_rent'=> 0,
            ]);

            for($k=1; $k <=5; $k++){
                CarPenalty::create([
                    "car_id"=> $car->id,
                    'name'=> $faker->name,
                    'description'=> $faker->text,
                    'notes'=> $faker->text,
                    'cost'=> rand(1000,9999),
                ]);
            }


        }
    }

    private function createConfig(){
        $faker = Faker::create();
        $company = array(
            "company-name"=>  $faker->city,
            "company-phone"=>  $faker->phoneNumber,
            "company-email"=>  $faker->unique()->safeEmail,
            "company-website"=>  $faker->domainName,
            "company-address"=>  $faker->address,
        );
        foreach($company as $row => $key){
            Configuration::create([
                "name"=> $row,
                "slug"=> $row,
                "content"=> $key
            ]);
        }
        
    }

}
