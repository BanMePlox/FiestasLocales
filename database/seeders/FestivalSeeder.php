<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FestivalSeeder extends Seeder
{
    public function run(): void
    {
        $festivals = [
            [
                'name' => 'Fallas de Valencia',
                'municipality' => 'Valencia',
                'category' => 'Fallas',
                'description' => 'Les Falles de València és la festa més important de la Comunitat Valenciana i una de les més espectaculars d\'Europa. Durant cinc dies, enormes monuments satírics de cartró pedra omplin els carrers de la ciutat, fins que la nit del 19 de març la Cremà els redueix a cendres en un espectacle de foc i llum que paralitza la ciutat. Les Falles inclouen plantà, mascletà, ofrena de flors a la Mare de Déu dels Desamparats, bandes de música i milers de falleres i fallers vestits amb el traje típic.',
                'short_description' => 'La festa més espectacular de la Comunitat: monuments de cartró pedra, foc i pirotècnia.',
                'start_date' => '2026-03-15',
                'end_date' => '2026-03-19',
                'is_featured' => true,
                'website_url' => null,
                'address' => 'Ciudad de Valencia',
            ],
            [
                'name' => 'Moros y Cristianos de Alcoy',
                'municipality' => 'Alcoy',
                'category' => 'Moros y Cristianos',
                'description' => 'Les festes de Moros i Cristians d\'Alcoi, declarades Festa d\'Interès Turístic Internacional, se celebren en honor a Sant Jordi. Tres dies de desfilades brillants on milers de festeros vestits amb sumptuosos trajes representen la conquesta i reconquesta del castell. Alcoi és el bressol d\'aquesta festa que es celebra arreu de la Comunitat Valenciana.',
                'short_description' => 'La festa de Moros i Cristians més antiga i emblemàtica de la Comunitat Valenciana.',
                'start_date' => '2026-04-22',
                'end_date' => '2026-04-24',
                'is_featured' => true,
                'website_url' => null,
                'address' => 'Alcoy, Alicante',
            ],
            [
                'name' => 'Hogueras de San Juan de Alicante',
                'municipality' => 'Alicante',
                'category' => 'Hogueras de San Juan',
                'description' => 'Les Fogueres de Sant Joan d\'Alacant, declarades Festa d\'Interès Turístic Nacional, se celebren cada juny. Enormes monuments satírics s\'alçen pels barris de la ciutat i cremen la nit del 24. La festa inclou mascletà, bous al carrer, la Nit del Foc i el tradicional bany a la platja a la mitjanit.',
                'short_description' => 'Fogueres gegants, mascletà i el tradicional bany de Sant Joan a les platges d\'Alacant.',
                'start_date' => '2026-06-20',
                'end_date' => '2026-06-24',
                'is_featured' => true,
                'website_url' => null,
                'address' => 'Alicante ciudad',
            ],
            [
                'name' => 'La Tomatina de Buñol',
                'municipality' => 'Buñol',
                'category' => 'Festes Patronals',
                'description' => 'La Tomatina és una festa única al món que se celebra l\'últim dimecres d\'agost a Buñol. Milers de participants de tot el món es llancen tomates els uns als altres durant una hora en una batalla càrnera i festiva que ha conquistat fama mundial. Declarada Festa d\'Interès Turístic Internacional.',
                'short_description' => 'La batalla de tomates més famosa del món, declarada Festa d\'Interès Turístic Internacional.',
                'start_date' => '2026-08-26',
                'end_date' => '2026-08-26',
                'is_featured' => true,
                'website_url' => null,
                'address' => 'Buñol, Valencia',
            ],
            [
                'name' => 'Semana Santa Marinera de Valencia',
                'municipality' => 'Valencia',
                'category' => 'Semana Santa',
                'description' => 'La Setmana Santa Marinera és una de les processons més antigues i emotives de la Comunitat Valenciana, organitzada pels barris mariners del Cabanyal i el Grau. Les imatges processionen per carrers estrets i les confraries desfilen amb els seus misteris en un ambient íntim i recollidor.',
                'short_description' => 'Processons emotives pels barris mariners del Cabanyal i el Grau de la mar.',
                'start_date' => '2026-03-29',
                'end_date' => '2026-04-05',
                'is_featured' => false,
                'website_url' => null,
                'address' => 'Barri del Cabanyal, Valencia',
            ],
            [
                'name' => 'Misteri d\'Elx',
                'municipality' => 'Elche',
                'category' => 'Festes Patronals',
                'description' => 'El Misteri d\'Elx és un drama sacroliric medieval declarat Patrimoni Immaterial de la Humanitat per la UNESCO. Se representa cada agost a la Basílica de Santa Maria i narra l\'Assumpció de la Mare de Déu. Una experiència cultural única que conserva una tradició de cinc segles.',
                'short_description' => 'Drama medieval declarat Patrimoni Immaterial de la Humanitat per la UNESCO.',
                'start_date' => '2026-08-11',
                'end_date' => '2026-08-15',
                'is_featured' => true,
                'website_url' => null,
                'address' => 'Basílica de Santa Maria, Elche',
            ],
            [
                'name' => 'Fira i Festes de la Magdalena',
                'municipality' => 'Castellón de la Plana',
                'category' => 'Fira',
                'description' => 'Les Festes de la Magdalena commemoren la fundació de Castelló de la Plana al pla i la baixada dels pobladors de la Serra d\'En Galceran. La Romeria de les Canyes és el moment culminant, quan milers de castellonenses pugen a l\'ermita de la Magdalena. Nou dies de festes amb bous, gaiata i música.',
                'short_description' => 'Noves dies de festes que commemoren la fundació de Castelló de la Plana al 1251.',
                'start_date' => '2026-03-07',
                'end_date' => '2026-03-15',
                'is_featured' => false,
                'website_url' => null,
                'address' => 'Castellón de la Plana',
            ],
            [
                'name' => 'Bous a la Mar de Dénia',
                'municipality' => 'Dénia',
                'category' => 'Bous al carrer',
                'description' => 'Els Bous a la Mar de Dénia són una festa única on els bous i els corredors acaben llançant-se al mar davant de la costa. Se celebra cada estiu i combina la tradició taurina amb l\'entorn marítim en un espectacle que atreu milers d\'espectadors de tota la Comunitat.',
                'short_description' => 'El bou i el corredor acaben llançant-se al mar en aquest espectacle únic a Dénia.',
                'start_date' => '2026-07-04',
                'end_date' => '2026-07-12',
                'is_featured' => false,
                'website_url' => null,
                'address' => 'Port de Dénia, Valencia',
            ],
            [
                'name' => 'Semana Santa de Orihuela',
                'municipality' => 'Orihuela',
                'category' => 'Semana Santa',
                'description' => 'La Setmana Santa d\'Oriola, declarada Festa d\'Interès Turístic Internacional, és una de les processons més solemnes i antigues d\'Espanya. Les confraries desfilen per l\'escenari monumental del centre històric d\'Oriola amb imatges barroques d\'una bellesa extraordinària.',
                'short_description' => 'Processons solemnes declarades Festa d\'Interès Turístic Internacional a Oriola.',
                'start_date' => '2026-03-29',
                'end_date' => '2026-04-05',
                'is_featured' => false,
                'website_url' => null,
                'address' => 'Centro histórico de Orihuela',
            ],
            [
                'name' => 'Romeria de la Magdalena',
                'municipality' => 'Castellón de la Plana',
                'category' => 'Romeria',
                'description' => 'La Romeria de les Canyes és el moment central de les Festes de la Magdalena. Milers de castellonenses pugen a l\'ermita de la Magdalena portant canyes verdes, en un pelegrinatge que recorda la fundació de la ciutat. Una tradició popular que es manté viva des del segle XIII.',
                'short_description' => 'Pelegrinatge popular a l\'ermita de la Magdalena portant canyes verdes.',
                'start_date' => '2026-03-08',
                'end_date' => '2026-03-08',
                'is_featured' => false,
                'website_url' => null,
                'address' => 'Ermita de la Magdalena, Castellón',
            ],
            [
                'name' => 'Festes de la Mare de Déu de la Salut de Algemesí',
                'municipality' => 'Algemesí',
                'category' => 'Festes Patronals',
                'description' => 'La Festa de la Mare de Déu de la Salut d\'Algemesí, Patrimoni Immaterial de la Humanitat per la UNESCO, és una processó de danses i músiques que es celebra cada 7 i 8 de setembre. La muixeranga, la dansa dels bastonets i els gegants fan d\'aquesta festa una experiència cultural única.',
                'short_description' => 'Processó de danses Patrimoni de la UNESCO amb la icònica muixeranga valenciana.',
                'start_date' => '2026-09-07',
                'end_date' => '2026-09-08',
                'is_featured' => true,
                'website_url' => null,
                'address' => 'Algemesí, Valencia',
            ],
            [
                'name' => 'Moros y Cristianos de Villena',
                'municipality' => 'Villena',
                'category' => 'Moros y Cristianos',
                'description' => 'Les Festes de Moros i Cristians de Villena, declarades Festa d\'Interès Turístic Nacional, se celebren en honor a la Mare de Déu de les Virtuts. Cinc dies de desfilades impressionants amb vint filades que exhibeixen els seus sumptuosos trajes pels carrers del centre histèric de Villena.',
                'short_description' => 'Cinc dies de desfilades sumptuoses declarades Festa d\'Interès Turístic Nacional.',
                'start_date' => '2026-09-05',
                'end_date' => '2026-09-09',
                'is_featured' => false,
                'website_url' => null,
                'address' => 'Villena, Alicante',
            ],
            [
                'name' => 'Festes de la Magdalena de Castellón',
                'municipality' => 'Castellón de la Plana',
                'category' => 'Fira',
                'description' => 'Nou dies de festes on Castelló viu les seues festes majors. A la tradicional Romeria de les Canyes s\'afegeixen desfilades de gegants i cabuts, actuacions musicals, concursos gastronòmics i els populars bous al carrer. Un calendari dens d\'activitats per a tots els gustos i edats.',
                'short_description' => 'Nou dies de festes majors amb romeria, bous, música i tradicions centenàries.',
                'start_date' => '2026-03-07',
                'end_date' => '2026-03-15',
                'is_featured' => false,
                'website_url' => null,
                'address' => 'Castellón de la Plana',
            ],
            [
                'name' => 'Certamen Internacional de Bandes de Música',
                'municipality' => 'Valencia',
                'category' => 'Música y Bandas',
                'description' => 'El Certamen Internacional de Bandes de Música de la Comunitat Valenciana és un dels concursos de bandes més prestigiosos del món. La tradició musical valenciana, arrelada als pobles i les societats musicals, se celebra cada octubre al Palau de la Música de València amb bandes de tot el món.',
                'short_description' => 'El concurs de bandes de música més prestigiós del món, al Palau de la Música de València.',
                'start_date' => '2026-10-17',
                'end_date' => '2026-10-18',
                'is_featured' => false,
                'website_url' => null,
                'address' => 'Palau de la Música, Valencia',
            ],
            [
                'name' => 'Fogueres de Sant Antoni de Morella',
                'municipality' => 'Morella',
                'category' => 'Fogueres',
                'description' => 'Les fogueres de Sant Antoni de Morella encenen la nit del 16 de gener amb enormes bonics davant de la muralla medieval. La festa inclou el tradicional correfoc, la benedicció dels animals i un mercat medieval que transforma la vila en un escenari d\'altra època.',
                'short_description' => 'Fogueres espectaculars davant de la muralla medieval de Morella al gener.',
                'start_date' => '2026-01-16',
                'end_date' => '2026-01-17',
                'is_featured' => false,
                'website_url' => null,
                'address' => 'Morella, Castellón',
            ],
        ];

        $municipalityIds = DB::table('municipalities')->pluck('id', 'name');
        $categoryIds = DB::table('categories')->pluck('id', 'name');

        foreach ($festivals as $festival) {
            $municipalityId = $municipalityIds[$festival['municipality']] ?? null;
            $categoryId = $categoryIds[$festival['category']] ?? null;

            if (!$municipalityId || !$categoryId) {
                continue;
            }

            $slug = Str::slug($festival['name']);
            $originalSlug = $slug;
            $counter = 1;

            while (DB::table('festivals')->where('slug', $slug)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }

            DB::table('festivals')->insertOrIgnore([
                'municipality_id'   => $municipalityId,
                'category_id'       => $categoryId,
                'name'              => $festival['name'],
                'slug'              => $slug,
                'description'       => $festival['description'],
                'short_description' => $festival['short_description'],
                'start_date'        => $festival['start_date'],
                'end_date'          => $festival['end_date'],
                'is_active'         => true,
                'is_featured'       => $festival['is_featured'],
                'website_url'       => $festival['website_url'],
                'address'           => $festival['address'],
                'views_count'       => rand(100, 5000),
                'published_at'      => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}
