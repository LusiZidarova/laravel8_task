<?php
 namespace App\Repositories;

 use Illuminate\Support\ServiceProvider;

 class RepositoriesServiceProvider extends ServiceProvider {

    public function register(){
        $this->app->bind(
            'App\Repositories\IStreamInterface',
            'App\Repositories\StreamRepository'
        );
    }
 }