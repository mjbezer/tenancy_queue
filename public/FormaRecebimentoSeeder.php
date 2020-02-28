<?php

use Illuminate\Database\Seeder;
use AtitudeAgenda\Models\FormaRecebimento;

class FormaRecebimentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $formaRecebimento = new FormaRecebimento;
        $formaRecebimento->forma = 'Dinheiro';
        $formaRecebimento->status = 1;
        $formaRecebimento->save();

        $formaRecebimento = new FormaRecebimento;
        $formaRecebimento->forma = 'Cheque';
        $formaRecebimento->status = 1;
        $formaRecebimento->save();

        $formaRecebimento = new FormaRecebimento;
        $formaRecebimento->forma = 'Boleto Bancário';
        $formaRecebimento->status = 1;
        $formaRecebimento->save();

        
        $formaRecebimento = new FormaRecebimento;
        $formaRecebimento->forma = 'Cartão de Crédito';
        $formaRecebimento->status = 1;
        $formaRecebimento->save();

        $formaRecebimento = new FormaRecebimento;
        $formaRecebimento->forma = 'Cartão de Débito';
        $formaRecebimento->status = 1;
        $formaRecebimento->save();


        $formaRecebimento = new FormaRecebimento;
        $formaRecebimento->forma = 'Depósito Bancário';
        $formaRecebimento->status = 1;
        $formaRecebimento->save();


        $formaRecebimento = new FormaRecebimento;
        $formaRecebimento->forma = 'PagSeguro';
        $formaRecebimento->status = 1;
        $formaRecebimento->save();


        $formaRecebimento = new FormaRecebimento;
        $formaRecebimento->forma = 'MercadoPago';
        $formaRecebimento->status = 1;
        $formaRecebimento->save();


        $formaRecebimento = new FormaRecebimento;
        $formaRecebimento->forma = 'Outros';
        $formaRecebimento->status = 1;
        $formaRecebimento->save();
    }
}
