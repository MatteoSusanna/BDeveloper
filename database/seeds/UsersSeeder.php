<?php

use App\User;
use App\Review;
use App\Message;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Faker\Generator as Faker;
use Illuminate\Support\Str; 

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $developerArray = [
            [
                "name" => "Paolo",
                "lastname" => "Rossi",
                "address" => "Via milano 27",
                "email" => "paolo.rossi@gmail.com",
                "password" => Hash::make("paolorossi"),
                "curriculum" => null,
                "phone" => 3451298456,
                "cover" => null,
                "hourly_wage" => 12.50,
            ],
            [
                "name" => "Anna",
                "lastname" => "Bianchi",
                "address" => "Via roma 54",
                "email" => "anna.bianchi@gmail.com",
                "password" => Hash::make("annabianchi"),
                "curriculum" => null,
                "phone" => 3451745268,
                "cover" => null,
                "hourly_wage" => 20,
            ],
            [
                "name" => "Marco",
                "lastname" => "Gialli",
                "address" => "Via andrelli 3",
                "email" => "marco.gialli@gmail.com",
                "password" => Hash::make("marcogialli"),
                "curriculum" => null,
                "phone" => 4579125864,
                "cover" => null,
                "hourly_wage" => 12.50,
            ],
            [
                "name" => "Luca",
                "lastname" => "Rossi",
                "address" => "Via lucca 35",
                "email" => "luca.rossi@gmail.com",
                "password" => Hash::make("lucarossi"),
                "curriculum" => null,
                "phone" => 4872369514,
                "cover" => null,
                "hourly_wage" => 50,
            ],
            [
                "name" => "Mario",
                "lastname" => "Bossi",
                "address" => "Via casesparse 307",
                "email" => "mario.bossi@gmail.com",
                "password" => Hash::make("mariobossi"),
                "curriculum" => null,
                "phone" => 7412685934,
                "cover" => null,
                "hourly_wage" => 12,
            ],
            [
                "name" => "Laura",
                "lastname" => "Fiorenza",
                "address" => "piazza laurenti 1",
                "email" => "laura.fiorenza@gmail.com",
                "password" => Hash::make("laurafiorenza"),
                "curriculum" => null,
                "phone" => 7896213554,
                "cover" => null,
                "hourly_wage" => 41,
            ],
            [
                "name" => "Giovanna",
                "lastname" => "Verdi",
                "address" => "Via merli 88",
                "email" => "giovanna.verdi@gmail.com",
                "password" => Hash::make("giovannaverdi"),
                "curriculum" => null,
                "phone" => 7426981349,
                "cover" => null,
                "hourly_wage" => 11.40,
            ],
            [
                "name" => "Paola",
                "lastname" => "Esposito",
                "address" => "Via mariomerola 55",
                "email" => "paola.esposito@gmail.com",
                "password" => Hash::make("paolaesposito"),
                "curriculum" => null,
                "phone" => 1523698452,
                "cover" => null,
                "hourly_wage" => 10.50,
            ],
            [
                "name" => "Ernesto",
                "lastname" => "Preso",
                "address" => "Via forgia 37",
                "email" => "ernesto.preso@gmail.com",
                "password" => Hash::make("ernestopreso"),
                "curriculum" => null,
                "phone" => 4579826410,
                "cover" => null,
                "hourly_wage" => 100,
            ],
            [
                "name" => "Martina",
                "lastname" => "Merlo",
                "address" => "Via gioia 7",
                "email" => "martina.merlo@gmail.com",
                "password" => Hash::make("martinamerlo"),
                "curriculum" => null,
                "phone" => 7901235004,
                "cover" => null,
                "hourly_wage" => 50,
            ],
            [
                "name" => "Maria",
                "lastname" => "Rosa",
                "address" => "Via benedetta 12",
                "email" => "maria.rosa@gmail.com",
                "password" => Hash::make("mariarosa"),
                "curriculum" => null,
                "phone" => 7452301958,
                "cover" => null,
                "hourly_wage" => 33,
            ],
            [
                "name" => "Luigi",
                "lastname" => "Ricci",
                "address" => "Cosro tana 57",
                "email" => "luigi.ricci@gmail.com",
                "password" => Hash::make("luigiricci"),
                "curriculum" => null,
                "phone" => 7549821645,
                "cover" => null,
                "hourly_wage" => 22.10,
            ],
            [
                "name" => "Beatrice",
                "lastname" => "Lures",
                "address" => "Via martini 8",
                "email" => "beatrice.lures@gmail.com",
                "password" => Hash::make("beatricelures"),
                "curriculum" => null,
                "phone" => 7410258963,
                "cover" => null,
                "hourly_wage" => 46,
            ],
            [
                "name" => "Marta",
                "lastname" => "Lucci",
                "address" => "Via del pescato 88",
                "email" => "marta.lucci@gmail.com",
                "password" => Hash::make("martalucci"),
                "curriculum" => null,
                "phone" => 4852169200,
                "cover" => null,
                "hourly_wage" => 10,
            ],
            [
                "name" => "Michela",
                "lastname" => "Gira",
                "address" => "Via tondo 66",
                "email" => "michela.gira@gmail.com",
                "password" => Hash::make("michelagira"),
                "curriculum" => null,
                "phone" => 3154978520,
                "cover" => null,
                "hourly_wage" => 19,
            ],
            [
                "name" => "Lino",
                "lastname" => "Gialli",
                "address" => "Via fiore 44",
                "email" => "lino.gialli@gmail.com",
                "password" => Hash::make("linogialli"),
                "curriculum" => null,
                "phone" => 5552164980,
                "cover" => null,
                "hourly_wage" => 90,
            ],
            [
                "name" => "Veronica",
                "lastname" => "Domini",
                "address" => "Via admin 5",
                "email" => "veronica.domini@gmail.com",
                "password" => Hash::make("veronicadomini"),
                "curriculum" => null,
                "phone" => 4587126304,
                "cover" => null,
                "hourly_wage" => 45.50,
            ],
            [
                "name" => "Antonio",
                "lastname" => "Erba",
                "address" => "Via sergio 2",
                "email" => "antonio.erma@gmail.com",
                "password" => Hash::make("antonioerba"),
                "curriculum" => null,
                "phone" => 4587621359,
                "cover" => null,
                "hourly_wage" => 22.70,
            ],
            [
                "name" => "Lorenzo",
                "lastname" => "Berto",
                "address" => "Via dante 7",
                "email" => "lorenzo.berto@gmail.com",
                "password" => Hash::make("lorenzoberto"),
                "curriculum" => null,
                "phone" => 4102367895,
                "cover" => null,
                "hourly_wage" => 44,
            ],
            [
                "name" => "Luisa",
                "lastname" => "Rossi",
                "address" => "Via colori 96",
                "email" => "luisa.rossi@gmail.com",
                "password" => Hash::make("luisarossi"),
                "curriculum" => null,
                "phone" => 4102579634,
                "cover" => null,
                "hourly_wage" => 80,
            ]
        ];

        foreach ($developerArray as $developer) {
            $NewDeveloper = new User();
            $NewDeveloper->name = $developer['name'];
            $NewDeveloper->lastname = $developer['lastname'];
            $NewDeveloper->address = $developer ['address'];
            $NewDeveloper->email = $developer['email'];
            $NewDeveloper->password = $developer['password'];
            $NewDeveloper->curriculum = $developer['curriculum'];
            $NewDeveloper->phone = $developer['phone'];
            $contents = new File(__DIR__ . '/../../storage/app/img/' . rand(1, 5) . '.jpg');
            $NewDeveloper->cover = Storage::put('uploads', $contents);
            $NewDeveloper->hourly_wage = $developer['hourly_wage'];
            $NewDeveloper->Slug=Str::slug($developer['name']  . '-' . $developer['lastname'], '-');
            $NewDeveloper->save();
            $NewDeveloper->specialization()->attach($faker->numberBetween(1, 3));
            $NewDeveloper->skill()->attach($faker->numberBetween(1, 6));
            $NewDeveloper->skill()->attach($faker->numberBetween(7, 12));;
            
            for ($i = 0; $i < rand(1, 2000); $i++) {
                $review = new Review();
                $review->name = $developer['name'];
                $review->vote = rand(1, 5);
                $review->text = $faker->text(50);
                $review->lastname = $developer['lastname'];
                $NewDeveloper->review()->save($review);
            }

            for ($i = 0; $i < rand(1, 25); $i++) {
                $message = new Message();
                $message->name = $developer['name'];
                $message->email = $developer['email'];
                $message->text = $faker->text(50);
                $message->lastname = $developer['lastname'];
                $NewDeveloper->message()->save($message);
            }
        };
    }
}