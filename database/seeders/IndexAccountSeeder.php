<?php

namespace Database\Seeders;
use App\Models\IndexAccount;
use Illuminate\Database\Seeder;

class IndexAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $link = IndexAccount::create([
            'account_number'  => '10000',
            'account_name'    =>'الأصول',
            'index_account_id'=>0,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);
        $linkmtadawyla = IndexAccount::create([
            'account_number'  => '11000',
            'account_name'    =>'الاصول المتداولة',
            'index_account_id'=>$link->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $linkam = IndexAccount::create([
            'account_number'  => '11100',
            'account_name'    =>'الصندوق العام',
            'index_account_id'=>$linkmtadawyla->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '11110',
            'account_name'    =>'صندوق الشيقل',
            'index_account_id'=>$linkam->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '11120',
            'account_name'    =>'صندوق الدولار',
            'index_account_id'=>$linkam->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $linkbank = IndexAccount::create([
            'account_number'  => '11200',
            'account_name'    =>'البنوك',
            'index_account_id'=>$linkmtadawyla->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '11210',
            'account_name'    =>'بنك فلسطين شيقل',
            'index_account_id'=>$linkbank->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '11300',
            'account_name'    =>'حافظة الشيكات',
            'index_account_id'=>$linkmtadawyla->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '11600',
            'account_name'    =>'المدينين',
            'index_account_id'=>$linkmtadawyla->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '11700',
            'account_name'    =>'بضاعة آخر المدة',
            'index_account_id'=>$linkmtadawyla->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);
        
        $link = IndexAccount::create([
            'account_number'  => '11800',
            'account_name'    =>'مصروفات مدفوعة مقدما',
            'index_account_id'=>$linkmtadawyla->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);
        
        $link = IndexAccount::create([
            'account_number'  => '11900',
            'account_name'    =>'أرصدة مدينة أخرى',
            'index_account_id'=>$linkmtadawyla->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $linkthapta = IndexAccount::create([
            'account_number'  => '12000',
            'account_name'    =>'الاصول الثابتة',
            'index_account_id'=>$link->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '12001',
            'account_name'    =>'السيارات',
            'index_account_id'=>$linkthapta->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '12002',
            'account_name'    =>'الآلآت',
            'index_account_id'=>$linkthapta->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $linkaleltizamat = IndexAccount::create([
            'account_number'  => '20000',
            'account_name'    =>'الالتزامات',
            'index_account_id'=>0,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '21000',
            'account_name'    =>'الالتزامات المتداولة',
            'index_account_id'=>$linkaleltizamat->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);
        
        $link = IndexAccount::create([
            'account_number'  => '21100',
            'account_name'    =>'القروض',
            'index_account_id'=>$linkaleltizamat->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);
        
        $link = IndexAccount::create([
            'account_number'  => '21200',
            'account_name'    =>'مستحقات الضرائب',
            'index_account_id'=>$linkaleltizamat->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);
        
        $link = IndexAccount::create([
            'account_number'  => '21300',
            'account_name'    =>'الموردون (الدائنون)',
            'index_account_id'=>$linkaleltizamat->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);
        $link = IndexAccount::create([
            'account_number'  => '21400',
            'account_name'    =>'شيكات برسم الدفع',
            'index_account_id'=>$linkaleltizamat->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '21500',
            'account_name'    =>'مصروفات مستحقة',
            'index_account_id'=>$linkaleltizamat->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $linkmalkya = IndexAccount::create([
            'account_number'  => '30000',
            'account_name'    =>'حقوق الملكية',
            'index_account_id'=>$link->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '31000',
            'account_name'    =>'راس المال',
            'index_account_id'=>$linkmalkya->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);
        $link = IndexAccount::create([
            'account_number'  => '32000',
            'account_name'    =>'صافي ربح/ خسارة',
            'index_account_id'=>$linkmalkya->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>1,
        ]);

        $linktaklofasell = IndexAccount::create([
            'account_number'  => '40000',
            'account_name'    =>'تكلفة البضاعة المتاحة للبيع',
            'index_account_id'=>0,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>3,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '41000',
            'account_name'    =>'بضاعة اول المدة',
            'index_account_id'=>$linktaklofasell->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>3,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '42000',
            'account_name'    =>'المشتريات',
            'index_account_id'=>$linktaklofasell->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>3,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '43000',
            'account_name'    =>'مردودات المشتريات',
            'index_account_id'=>$linktaklofasell->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>3,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '44000',
            'account_name'    =>'خصم مكتسب',
            'index_account_id'=>$linktaklofasell->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>3,
        ]);

        $linkNetsales = IndexAccount::create([
            'account_number'  => '60000',
            'account_name'    =>'صافي المبيعات',
            'index_account_id'=>0,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>3,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '61000',
            'account_name'    =>'اجمالي المبيعات',
            'index_account_id'=>$linkNetsales->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>3,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '62000',
            'account_name'    =>'مرجع المبيعات',
            'index_account_id'=>$linkNetsales->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>3,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '63000',
            'account_name'    =>'خصم مسموح به',
            'index_account_id'=>$linkNetsales->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>3,
        ]);

        $linkRevenues = IndexAccount::create([
            'account_number'  => '70000',
            'account_name'    =>'الايرادات',
            'index_account_id'=>$linkNetsales->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>2,
        ]);


        $link = IndexAccount::create([
            'account_number'  => '71000',
            'account_name'    =>'ايرادات حفر خشب',
            'index_account_id'=>$linkRevenues->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>3,
        ]);

        $linkexpenses = IndexAccount::create([
            'account_number'  => '80000',
            'account_name'    =>'المصروفات',
            'index_account_id'=>0,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>2,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '80001',
            'account_name'    =>'م. الايجار',
            'index_account_id'=>$linkexpenses->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>2,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '80002',
            'account_name'    =>'م. رواتب وأجور',
            'index_account_id'=>$linkexpenses->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>2,
        ]);

        $linkdepreciationcompound = IndexAccount::create([
            'account_number'  => '90000',
            'account_name'    =>'مجمع الاهلاكات',
            'index_account_id'=>0,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>3,
        ]);

        $link = IndexAccount::create([
            'account_number'  => '90001',
            'account_name'    =>'مجمع اهلاك السيارات',
            'index_account_id'=>$linkdepreciationcompound->id,
            'balance'  => 0,
            'basic'     => 0,
            'account_guide_id'=>3,
        ]);


    }
}
