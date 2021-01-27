<?php

namespace App\Providers;
use App\Like;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('update-article', function ($user, $article) {
            if($article->user_id == $user->id){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('delete-comment', function ($user, $comment) {
            if($comment->user_id == $user->id){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('like-article', function ($user, $article) {
            $ya_hay_like = Like::where('article_id', $article->id)->where('user_id', $user->id)->first();
            if(empty($ya_hay_like)){
                return true;
            }else{
                return false;
            }
        });
    }
}
