<?php

namespace Tests\Browser;

use App\Services\TestReprotService ;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use PHPUnit\Metadata\Test;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{
    protected TestReprotService $report;

    protected function setUp(): void
        {
            parent::setUp();
            $this->report = new TestReprotService();
        }

    protected function tearDown(): void
        {
            $this->report->generatePdf();
            parent::tearDown();
        }

    public function testUserRegistrationWithStripe()
    {
        $this->browse(function (Browser $browser) {
            try {
                // Étape 1 : Inscription
                $browser->visit('http://stock.don.com/entreprise/create')
                        ->type('nom', 'Test User')
                        ->type('email', 'testopsistreprises@gmail.com')
                        ->type('adresse', 'Rue 123, Bamako')
                        ->type('telephone', '70000000')
                        ->press('Sign up')
                        ->assertPathBeginsWith('/paiement/licence');
                
                $browser->press('Payer ma licence maintenant')
                        ->assertPathBeginsWith('/c/pay/', 10);

                // Étape 2 : Paiement licence avec Stripe Elements
                $browser->type('card_number', '4242424242424242')   // carte test Stripe
                        ->type('card_expiry', '12/30')
                        ->type('card_cvc', '123')
                        ->press('Payer');

                // Étape 3 : Retour après paiement
                $browser->waitForLocation('/login', 20)
                        ->assertSee('Paiement réussi');

                $this->report->addResult(
                    'Inscription SaaS avec Stripe',
                    true,
                    'Inscription et paiement simulés avec carte test Stripe.'
                );

            } catch (\Exception $e) {
                $screenshot = 'tests/Browser/screenshots/registration_error.png';
                $browser->screenshot('registration_error');

                $this->report->addResult(
                    'Inscription SaaS avec Stripe',
                    false,
                    $e->getMessage(),
                    $screenshot
                );
            }
        });
    }

}
