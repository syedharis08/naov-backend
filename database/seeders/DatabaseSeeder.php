<?php

namespace Database\Seeders;

use App\Models\Carrier;
use App\Models\SeaPort;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(CountriesTableSeeder::class);
        $this->call(StatesTableSeeder::class);
        $this->call(ServicesTableSeeder::class);
        $this->call(RolesTableSeeder::class);

        $shipment_lines = [
            'COSCO',
            'CMA CGM',
            'OOCL',
            'MSC',
            'MAERSK',
            'Hapag-Llyod',
            'IAL',
            'PIL',
            'YML',
            'PERMA',
            'KMTC',
            'OSL',
            'ONE',
            'Zim',
            'EMC',
            'YMM',
            'EVERGREEN',
            'MOL',
            'TS Line',
            'Hanjin Shipping',
            'HMM',
            'NILE DUTCH',
            'UASC',
            'CSCL',
            'WHL',
            'X-Press Feeders Group',
            'Arkas Line',
            'Unifeeder',
            'Simatech',
            'K Line',
            'SKR',
            'APL',
            'China Shipping',
            'CSAV',
            'DELMAS',
            'Hamburg Sud',
            'Hatsu Marine',
            'Hyundai',
            'IRISL',
            'Llyod Triestino',
            'Norasia',
            'NYK',
            'P&O Nedlloyd',
            'Safmarnine',
            'Senator Lines',
            'Uniglory',
            'Yang Ming',
        ];

        foreach ($shipment_lines as $shipment_line) {
            Carrier::create(['name' => $shipment_line]);
            $this->call(UsersTableSeeder::class);
            $this->call(ForwarderUsersTableSeeder::class);
            $this->call(AddressesTableSeeder::class);
            $this->call(ContainersTableSeeder::class);
            $this->call(ShipperUsersTableSeeder::class);
        }

        $sea_ports = [
            'Shanghai, China',
            'Singapore',
            'Ningbo-Zhoushan, China',
            'Shenzhen, China',
            'Guangzhou Harbor, China',
            'Busan, South Korea',
            'Qingdao, China',
            'Hong Kong, S.A.R, China',
            'Tianjin, China',
            'Rotterdam, The Netherlands',
            'Jebel Ali, Dubai, United Arab Emirates',
            'Port Klang, Malaysia',
            'Xiamen, China',
            'Antwerp, Belgium',
            'Kaohsiung, Taiwan, China',
            'Dalian, China',
            'Los Angeles, U.S.A',
            'Hamburg, Germany',
            'Tanjung Pelepas, Malaysia',
            'Laem Chabang, Thailand',
            'Keihin Ports, Japan',
            'Long Beach, U.S.A.',
            'Tanjung Priok, Jakarta, Indonesia',
            'New York-New Jersey, U.S.A.',
            'Colombo, Sri Lanka',
            'Ho Chi Minh City, Vietnam',
            'Suzhou, China',
            'Piraeus, Greece',
            'Yingkou, China',
            'Valencia, Spain',
            'Manila, Philippines'
        ];

        foreach ($sea_ports as $sea_port) {
            SeaPort::create(['name' => $sea_port]);
        }
    }
}
