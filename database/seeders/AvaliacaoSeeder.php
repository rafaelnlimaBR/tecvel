<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AvaliacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('avaliacoes')->insert([
           [
               'cliente'        =>  "Ricardo Pinheiro Benevides",
               'texto'          =>  "Quero dar meus parabéns ao Rafael da tecvel, depois de ir em outro local que não resolveu o problema do painel no meu carro, fui até a tecvel e lá o Rafael me atendeu muito bem e resolveu meu problema rapidamente, ficou novo novamente.",
               'sequencia'      =>  "1",
               "habilitado"     =>  "1",
           ],
            [
                'cliente'        =>  "IFEC FORTALEZA",
                'texto'          =>  "Gostei bastante, deixei meu carro para fazer alguns testes no velocímetro, foi meio dia de testes, foi constatado que só era um mal contato. E o melhor, o Rafael não me cobrou nada, mesmo fazendo todos os testes para que fosse encontrado o mal funcionamento da velocímetro. Recomendo, empresa séria que trabalha com HONESTIDADE!",
                'sequencia'      =>  "2",
                "habilitado"     =>  "1",
            ],
            [
                'cliente'        =>  "Francisco Lima",
                'texto'          =>  "Ótimo profissional. Levei minha Twister com o painel completamente apagado e mesmo assim ele ainda conseguiu recuperar em pouco tempo. Recomendo demais. Parabéns pelo trabalho Rafael.",
                'sequencia'      =>  "3",
                "habilitado"     =>  "1",
            ],
            [
                'cliente'        =>  "Nilton Aires",
                'texto'          =>  "Excelência no atendimento desde o telefone ao pessoalmente, serviço rápido e de qualidade e com preço justo. PARABÉNS RAFAEL. Um ótimo profissional. Eu o recomendo.",
                'sequencia'      =>  "4",
                "habilitado"     =>  "1",
            ],[
                'cliente'        =>  "Marcos Araujo",
                'texto'          =>  "Gostei do atendimento e do serviço,  muito prestativo e atenção ao cliente, o serviço foi realizado dentro do prazo combinado.",
                'sequencia'      =>  "5",
                "habilitado"     =>  "1",
            ],[
                'cliente'        =>  "Junior Rancho",
                'texto'          =>  "Serviço  profissional  de qualidade sempre indico vc que precisa de um serviço de boa qualidade e atendimento personalizado boa sorte a todos #TECVEL  ELETRÔNICA AUTOMOTIVA",
                'sequencia'      =>  "6",
                "habilitado"     =>  "1",
            ],[
                'cliente'        =>  "Elizangela Mendes",
                'texto'          =>  "Maravilhoso! Rafael mto atencioso e resolveu rápido o painel apagado do meu carro. Recomendo!",
                'sequencia'      =>  "7",
                "habilitado"     =>  "1",
            ],
        ]);
    }
}
