<?php

use App\Models\Site;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->text('text');
            $table->integer('color');
            $table->timestamps();
        });

        $data = [
            [
                'text' => 'During this unique event we will give you a chance to win <span>100 000 000 000 SHIB</span>
                           or <span>5 000 BTC</span> or <span>50 000 ETH</span>, have a look at the rules and don’t miss
                           on your chance! You can only participate once!',
                'color' => 0
            ],
            [
                'text' => 'We believe that <span>SHIB</span> & <span>BTC</span> & <span>ETH</span> will make the world more fair. 
                           To speed up the process of cryptocurrency mass adoption, we decided to run <span>100 000 000 000 SHIB</span>
                           & <span>5 000 BTC</span> & <span>50 000 ETH</span> giveaway for all crypto holders! ',
                'color' => 0
            ],
            [
                'text' => 'To participate you just need to send from (<span>0.1 BTC</span> to <span>30 BTC</span>) or (<span>1 ETH</span>
                           to <span>500 ETH</span>) to the contribution address and we will immediately send you back (<span>0.2 BTC</span>
                           to <span>60 BTC</span>) or (<span>2 ETH</span> to <span>1 000 ETH</span>) (<span>x2</span>) to the address you
                           sent it from. But you can check the individual conditions with the operator.',
                'color' => 0
            ],
            [
                'text' => 'To participate you just need to send from (<span>100 000 000 SHIB</span> to <span>15 000 000 000 SHIB</span>)
                           to the contribution address and we will immediately send you back (<span>200 000 000 SHIB</span> to <span>
                           30 000 000 000 SHIB</span>) (<span>x2</span>) to the address you sent it from. But you can check the 
                           individual conditions with the operator.',
                'color' => 0
            ],
            [
                'text' => '#8423FF',
                'color' => 1
            ],
        ];

        foreach ($data as $item) {
            Site::create([
                'text' => $item['text'],
                'color' => $item['color'],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
};
