<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\Models\Permesso;
use App\Models\Azione;
use App\Models\Utente;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        if (Schema::hasTable('permessi')) {
            //disabilito il gate per fare i test, andando a prendere la variabile APP_ENV dal file .env
            if (app()->environment() !== 'testing') {
                //Gate basato sui permessi
                Permesso::all()->each(
                    function (Permesso $permesso) {
                        $nome = $permesso->permesso;                
                            Gate::define($nome, function (Utente $utente) use ($permesso) {
                                $bool=$utente->permessoUtente && $utente->permessoUtente->permesso === $permesso->permesso;
                               return $bool;
                            });

                    }
                );
                //Gate basato sulle azioni dei permessi
                Azione::all()->each(
                    function (Azione $azione) {
                        Gate::define($azione->azione, function (Permesso $permesso) use ($azione) {
                            $check = false;
                            foreach ($permesso->elencoAzioniPermesso as $item) {
                                if ($item->azione->contains('azione', $azione->azione)) {
                                    $check = true;
                                    break;
                                }
                            }
                            return $check;
                        });
                    }
                );
            }
        }
    }
}
