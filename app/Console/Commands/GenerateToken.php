<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class GenerateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shop:generate_token';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '快速生成jwt';

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
        $userId=$this->ask('请输入用户id');

        $user=User::find($userId);

        if(!$user){
            return $this->error('用户不存在');
        }


        $ttl=365*24*60;

        $this->info(auth('api')->setTTL($ttl)->login($user));
    }
}
