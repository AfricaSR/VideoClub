<?php
use App\Category;
use App\Movie;
use App\User;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		self::seedCategory();
		$this->call(CategoryTableSeeder::class);
		self::seedCatalog();
		self::seedUsers();
		$this->call(moviesTableSeeder::class);
		$this->call(UsersTableSeeder::class);

		$this->command->info('Tabla catálogo inicializada con datos!');
		$this->command->info('Tabla usuarios inicializada con datos!');

	

	}

	private function seedCategory() {

		DB::table('categories')->delete();

		foreach( $this->arrayCategories as $Category ) {
			$c = new Category ;
			$c->title = $Category['title'];
			$c->description = $Category['description'];
			$c->adult = $Category['adult'];
			$c->save();
		}

	}
	
	private function seedCatalog(){

		DB::table('movies')->delete();
		
		foreach( $this->arrayPeliculas as $pelicula ) {
			$p = new Movie;
			$p->title = $pelicula['title'];
			$p->year = $pelicula['year'];
			$p->director = $pelicula['director'];
			$p->poster = $pelicula['poster'];
			$p->rented = $pelicula['rented'];
			$p->trailer = $pelicula['trailer'];
			$p->synopsis = $pelicula['synopsis'];
			$p->category_id =$pelicula['category_id'];
			$p->save();
		}
	}

    private $arrayPeliculas = array(
		array(
			'title' => 'El padrino',
			'year' => '1972',
			'director' => 'Francis Ford Coppola',
			'poster' => 'https://ia.media-imdb.com/images/M/MV5BMjEyMjcyNDI4MF5BMl5BanBnXkFtZTcwMDA5Mzg3OA@@._V1_SX214_AL_.jpg',
			'rented' => false,
			'trailer' => '<iframe width="690" height="388" src="https://www.youtube.com/embed/gCVj1LeYnsc" frameborder="0 allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>',
			'synopsis' => 'Don Vito Corleone (Marlon Brando) es el respetado y temido jefe de una de las cinco familias de la mafia de Nueva York. Tiene cuatro hijos: Connie (Talia Shire), el impulsivo Sonny (James Caan), el pusilánime Freddie (John Cazale) y Michael (Al Pacino), que no quiere saber nada de los negocios de su padre. Cuando Corleone, en contra de los consejos de \'Il consigliere\' Tom Hagen (Robert Duvall), se niega a intervenir en el negocio de las drogas, el jefe de otra banda ordena su asesinato. Empieza entonces una violenta y cruenta guerra entre las familias mafiosas.',
			'category_id' => 1
		), array(
			'title' =>  'El Padrino. Parte II',
			'year' =>  '1974',
			'director' => 'Francis Ford Coppola',
			'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSxK9ROC2pyI3me2mirGzEWzD1hnbq6AXZu7M0YZDmFzkmU6F__',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Continuación de la historia de los Corleone por medio de dos historias paralelas: la elección de Michael Corleone como jefe de los negocios familiares y los orígenes del patriarca, el ya fallecido Don Vito, primero en Sicilia y luego en Estados Unidos, donde, empezando desde abajo, llegó a ser un poderosísimo jefe de la mafia de Nueva York.',
			'category_id' => 1
		), array(
			'title' =>  'La lista de Schindler',
			'year' =>  '1993',
			'director' => 'Steven Spielberg',
			'poster' => 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcSs7EbjWEudsBlXi-rCehHe49RsxfCSlxvbTFXHT0uaP_Yt1gis',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Segunda Guerra Mundial (1939-1945). Oskar Schindler (Liam Neeson), un hombre de enorme astucia y talento para las relaciones públicas, organiza un ambicioso plan para ganarse la simpatía de los nazis. Después de la invasión de Polonia por los alemanes (1939), consigue, gracias a sus relaciones con los nazis, la propiedad de una fábrica de Cracovia. Allí emplea a cientos de operarios judíos, cuya explotación le hace prosperar rápidamente. Su gerente (Ben Kingsley), también judío, es el verdadero director en la sombra, pues Schindler carece completamente de conocimientos para dirigir una empresa.',
			'category_id' => 4
		), array(
			'title' =>  'Pulp Fiction',
			'year' =>  '1994',
			'director' => 'Quentin Tarantino',
			'poster' => 'https://ia.media-imdb.com/images/M/MV5BMjE0ODk2NjczOV5BMl5BanBnXkFtZTYwNDQ0NDg4._V1_SY317_CR4,0,214,317_AL_.jpg',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Jules y Vincent, dos asesinos a sueldo con muy pocas luces, trabajan para Marsellus Wallace. Vincent le confiesa a Jules que Marsellus le ha pedido que cuide de Mia, su mujer. Jules le recomienda prudencia porque es muy peligroso sobrepasarse con la novia del jefe. Cuando llega la hora de trabajar, ambos deben ponerse manos a la obra. Su misión: recuperar un misterioso maletín. ',
			'category_id' => 1
		), array(
			'title' =>  'Cadena perpetua',
			'year' =>  '1994',
			'director' => 'Frank Darabont',
			'poster' => 'https://encrypted-tbn3.gstatic.com/images?q=tbn:ANd9GcTrBFXcfS56iTRtqQ9WbUB0bRcXz0A96V7NlPE2SaKBwQh6sxZ3',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Acusado del asesinato de su mujer, Andrew Dufresne (Tim Robbins), tras ser condenado a cadena perpetua, es enviado a la cárcel de Shawshank. Con el paso de los años conseguirá ganarse la confianza del director del centro y el respeto de sus compañeros de prisión, especialmente de Red (Morgan Freeman), el jefe de la mafia de los sobornos.',
			'category_id' => 4
		), array(
			'title' =>  'El golpe',
			'year' =>  '1973',
			'director' => 'George Roy Hill',
			'poster' => 'https://pics.filmaffinity.com/El_golpe-333620255-mmed.jpg',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Chicago, años treinta. Redford y Newman son dos timadores que deciden vengar la muerte de un viejo y querido colega, asesinado por orden de un poderoso gángster (Robert Shaw). Para ello urdirán un ingenioso y complicado plan con la ayuda de todos sus amigos y conocidos.',
			'category_id' => 1
		), array(
			'title' =>  'La vida es bella',
			'year' =>  '1997',
			'director' => 'Roberto Benigni',
			'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51tWTZJrHYL._SY445_.jpg',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'En 1939, a punto de estallar la Segunda Guerra Mundial (1939-1945), el extravagante Guido llega a Arezzo (Toscana) con la intención de abrir una librería. Allí conoce a Dora y, a pesar de que es la prometida del fascista Ferruccio, se casa con ella y tiene un hijo. Al estallar la guerra, los tres son internados en un campo de exterminio, donde Guido hará lo imposible para hacer creer a su hijo que la terrible situación que están padeciendo es tan sólo un juego.',
			'category_id' => 3
		), array(
			'title' =>  'Uno de los nuestros',
			'year' =>  '1990',
			'director' => 'Martin Scorsese',
			'poster' => 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQzForXrpDDjKQi3hLIxGUOkK6nhhO_sr8NcR0x1uvysgCWvsz7',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Henry Hill, hijo de padre irlandés y madre siciliana, vive en Brooklyn y se siente fascinado por la vida que llevan los gángsters de su barrio, donde la mayoría de los vecinos son inmigrantes. Paul Cicero, el patriarca de la familia Pauline, es el protector del barrio. A los trece años, Henry decide abandonar la escuela y entrar a formar parte de la organización mafiosa como chico de los recados; muy pronto se gana la confianza de sus jefes, gracias a lo cual irá subiendo de categoría. ',
			'category_id' => 4
		), array(
			'title' => 'Alguien voló sobre el nido del cuco',
			'year' =>  '1975',
			'director' => 'Milos Forman',
			'poster' => 'https://ia.media-imdb.com/images/M/MV5BMTk5OTA4NTc0NF5BMl5BanBnXkFtZTcwNzI5Mzg3OA@@._V1_SY317_CR12,0,214,317_AL_.jpg',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Randle McMurphy (Jack Nicholson), un hombre condenado por asalto, y un espíritu libre que vive contracorriente, es recluido en un hospital psiquiátrico. La inflexible disciplina del centro acentúa su contagiosa tendencia al desorden, que acabará desencadenando una guerra entre los pacientes y el personal de la clínica con la fría y severa enfermera Ratched (Louise Fletcher) a la cabeza. La suerte de cada paciente del pabellón está en juego.',
			'category_id' => 8
		), array(
			'title' =>  'American History X',
			'year' =>  '1998',
			'director' => 'Tony Kaye',
			'poster' => 'https://ia.media-imdb.com/images/M/MV5BMjMzNDUwNTIyMF5BMl5BanBnXkFtZTcwNjMwNDg3OA@@._V1_SY317_CR17,0,214,317_AL_.jpg',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Derek (Edward Norton), un joven "skin head" californiano de ideología neonazi, fue encarcelado por asesinar a un negro que pretendía robarle su furgoneta. Cuando sale de prisión y regresa a su barrio dispuesto a alejarse del mundo de la violencia, se encuentra con que su hermano pequeño (Edward Furlong), para quien Derek es el modelo a seguir, sigue el mismo camino que a él lo condujo a la cárcel.',
			'category_id' => 7
		), array(
			'title' => 'Sin perdón',
			'year' =>  '1992',
			'director' => 'Clint Eastwood',
			'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ5qfrlW49sIzWkN7EVGc-vAYl_TsUTIrd42r8Ysg02FwsEoKfS',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'William Munny (Clint Eastwood) es un pistolero retirado, viudo y padre de familia, que tiene dificultades económicas para sacar adelante a su hijos. Su única salida es hacer un último trabajo. En compañía de un viejo colega (Morgan Freeman) y de un joven inexperto (Jaimz Woolvett), Munny tendrá que matar a dos hombres que cortaron la cara a una prostituta.',
			'category_id' => 9
		), array(
			'title' =>  'El precio del poder',
			'year' =>  '1983',
			'director' => 'Brian De Palma',
			'poster' => 'https://ia.media-imdb.com/images/M/MV5BMjAzOTM4MzEwNl5BMl5BanBnXkFtZTgwMzU1OTc1MDE@._V1_SX214_AL_.jpg',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Tony Montana es un emigrante cubano frío y sanguinario que se instala en Miami con el propósito de convertirse en un gángster importante. Con la colaboración de su amigo Manny Rivera inicia una fulgurante carrera delictiva con el objetivo de acceder a la cúpula de una organización de narcos.',
			'category_id' => 1
		), array(
			'title' =>  'El pianista',
			'year' =>  '2002',
			'director' => 'Roman Polanski',
			'poster' => 'https://ia.media-imdb.com/images/M/MV5BMTc4OTkyOTA3OF5BMl5BanBnXkFtZTYwMDIxNjk5._V1_SX214_AL_.jpg',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Wladyslaw Szpilman, un brillante pianista polaco de origen judío, vive con su familia en el ghetto de Varsovia. Cuando, en 1939, los alemanes invaden Polonia, consigue evitar la deportación gracias a la ayuda de algunos amigos. Pero tendrá que vivir escondido y completamente aislado durante mucho tiempo, y para sobrevivir tendrá que afrontar constantes peligros.',
			'category_id' => 4
		), array(
			'title' =>  'Seven',
			'year' =>  '1995',
			'director' => 'David Fincher',
			'poster' => 'https://pics.filmaffinity.com/Seven_Se7en-734875211-mmed.jpg',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'El veterano teniente Somerset (Morgan Freeman), del departamento de homicidios, está a punto de jubilarse y ser reemplazado por el ambicioso e impulsivo detective David Mills (Brad Pitt). Ambos tendrán que colaborar en la resolución de una serie de asesinatos cometidos por un psicópata que toma como base la relación de los siete pecados capitales: gula, pereza, soberbia, avaricia, envidia, lujuria e ira. Los cuerpos de las víctimas, sobre los que el asesino se ensaña de manera impúdica, se convertirán para los policías en un enigma que les obligará a viajar al horror y la barbarie más absoluta.',
			'category_id' => 4
		), array(
			'title' =>  'El silencio de los corderos',
			'year' =>  '1991',
			'director' => 'Jonathan Demme',
			'poster' => 'https://ia.media-imdb.com/images/M/MV5BMTQ2NzkzMDI4OF5BMl5BanBnXkFtZTcwMDA0NzE1NA@@._V1_SX214_AL_.jpg',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'El FBI busca a "Buffalo Bill", un asesino en serie que mata a sus víctimas, todas adolescentes, después de prepararlas minuciosamente y arrancarles la piel. Para poder atraparlo recurren a Clarice Starling, una brillante licenciada universitaria, experta en conductas psicópatas, que aspira a formar parte del FBI. Siguiendo las instrucciones de su jefe, Jack Crawford, Clarice visita la cárcel de alta seguridad donde el gobierno mantiene encerrado a Hannibal Lecter, antiguo psicoanalista y asesino, dotado de una inteligencia superior a la normal. Su misión será intentar sacarle información sobre los patrones de conducta de "Buffalo Bill".',
			'category_id' => 5
		), array(
			'title' =>  'La naranja mecánica',
			'year' =>  '1971',
			'director' => 'Stanley Kubrick',
			'poster' => 'https://ia.media-imdb.com/images/M/MV5BMTY3MjM1Mzc4N15BMl5BanBnXkFtZTgwODM0NzAxMDE@._V1_SY317_CR0,0,214,317_AL_.jpg',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Gran Bretaña, en un futuro indeterminado. Alex (Malcolm McDowell) es un joven muy agresivo que tiene dos pasiones: la violencia desaforada y Beethoven. Es el jefe de la banda de los drugos, que dan rienda suelta a sus instintos más salvajes apaleando, violando y aterrorizando a la población. Cuando esa escalada de terror llega hasta el asesinato, Alex es detenido y, en prisión, se someterá voluntariamente a una innovadora experiencia de reeducación que pretende anular drásticamente cualquier atisbo de conducta antisocial.',
			'category_id' => 10
		), array(
			'title' =>  'La chaqueta metálica',
			'year' =>  '1987',
			'director' => 'Stanley Kubrick',
			'poster' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTyebNx1umLXobBO7E8e_OMyBy0zQH-ALJ7wsffBj3ya7mbv1ka',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Un grupo de reclutas se prepara en Parish Island, centro de entrenamiento de la marina norteamericana. Allí está el sargento Hartman, duro e implacable, cuya única misión en la vida es endurecer el cuerpo y el alma de los novatos, para que puedan defenderse del enemigo. Pero no todos los jóvenes están preparados para soportar sus métodos. ',
			'category_id' => 8
		), array(
			'title' =>  'Blade Runner',
			'year' =>  '1982',
			'director' => 'Ridley Scott',
			'poster' => 'https://is5-ssl.mzstatic.com/image/thumb/Video113/v4/c6/40/15/c640156c-0603-7dba-bb19-734c8f2c192e/pr_source.lsr/268x0w.jpg',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'A principios del siglo XXI, la poderosa Tyrell Corporation creó, gracias a los avances de la ingeniería genética, un robot llamado Nexus 6, un ser virtualmente idéntico al hombre pero superior a él en fuerza y agilidad, al que se dio el nombre de Replicante. Estos robots trabajaban como esclavos en las colonias exteriores de la Tierra. Después de la sangrienta rebelión de un equipo de Nexus-6, los Replicantes fueron desterrados de la Tierra. Brigadas especiales de policía, los Blade Runners, tenían órdenes de matar a todos los que no hubieran acatado la condena. Pero a esto no se le llamaba ejecución, se le llamaba "retiro". ',
			'category_id' => 7
		), array(
			'title' =>  'Taxi Driver',
			'year' =>  '1976',
			'director' => 'Martin Scorsese',
			'poster' => 'https://images-na.ssl-images-amazon.com/images/I/71bC-27PaHL._SY679_.jpg',
			'rented' => false,
			'trailer' => '',
			'synopsis' => 'Para sobrellevar el insomnio crónico que sufre desde su regreso de Vietnam, Travis Bickle (Robert De Niro) trabaja como taxista nocturno en Nueva York. Es un hombre insociable que apenas tiene contacto con los demás, se pasa los días en el cine y vive prendado de Betsy (Cybill Shepherd), una atractiva rubia que trabaja como voluntaria en una campaña política. Pero lo que realmente obsesiona a Travis es comprobar cómo la violencia, la sordidez y la desolación dominan la ciudad. Y un día decide pasar a la acción.',
			'category_id' => 1
		), array(
			'title' =>  'El club de la lucha',
			'year' =>  '1999',
			'director' => 'David Fincher',
			'poster' => 'https://pics.filmaffinity.com/El_club_de_la_lucha-381374539-large.jpg',
			'rented' => false,
			'trailer' => '',
		   'synopsis' => 'Un joven hastiado de su gris y monótona vida lucha contra el insomnio. En un viaje en avión conoce a un carismático vendedor de jabón que sostiene una teoría muy particular: el perfeccionismo es cosa de gentes débiles; sólo la autodestrucción hace que la vida merezca la pena. Ambos deciden entonces fundar un club secreto de lucha, donde poder descargar sus frustaciones y su ira, que tendrá un éxito arrollador.',
			'category_id' => 10
		)
	);
	
	private function seedUsers(){
		
		DB::table('users')->delete();

		foreach( $this->arrayUsers as $user ) {
			$u = new User;
			$u->name = $user['name'];
			$u->email = $user['email'];
			$u->password = bcrypt($user['password']);
			$u->save();
		}

	}

	private $arrayUsers = array(
		array(
			'name' => 'Bonifacio',
			'email' => 'Bonifacio@avichuelo.es', 
			'password' => 'abcd1234'
		),
		array(
			'name' => 'Rodolfo',
			'email' => 'Rodolfo@Chikilicutre.com', 
			'password' => 'abcd1234'
		)
	);

	private $arrayCategories = array(
		array(
			'title' => 'Acción', 
			'description' => 'El cine de acción es un género cinematográfico en el que prima la espectacularidad de las imágenes por medio de efectos especiales dejando al margen cualquier otra consideración.', 
			'adult' => false
		),
		array(
			'title' => 'Aventuras', 
			'description' => 'Dado que se trata de un modelo dramático sin una ambientación específica, conviene aclarar que el género de aventuras puede generar argumentos de inspiración policíaca, histórica o bélica; con una trama ficticia cuyo objetivo principal consiste en exponer una secuencia cautivante de acciones sin llevar a una reflexión sobre las mismas (propósito de simple entretenimiento “liviano”).', 
			'adult' => false
		),
		array(
			'title' => 'Comedia', 
			'description' => 'Género que busca la carcajada en el espectador mediante episodios de humor elemental, grotesco o absurdo, carente de matices o profundidad psicológica. Las películas de cine cómico son una sucesión de gags hilvanados y -a diferencia de la comedia- no poseen una estructura dramática precisa, progreso narrativo o evolución en los personajes.', 
			'adult' => false
		),
		array(
			'title' => 'Drama', 
			'description' => 'El término vendría a describir, más que un género, una forma de narrar, basada en los giros súbitos de la acción, el juego simplificado de connotaciones morales y el resorte sentimental y apasionado que mueve a los personajes.', 
			'adult' => false
		),
		array(
			'title' => 'Terror', 
			'description' => 'Su trama –con o sin elementos fantásticos– va dirigida a producir en el espectador emociones como miedo, temor o pánico y jugar con estas emociones al someterlo a suspensos, sobresaltos y ansiedades.', 
			'adult' => true
		),
		array(
			'title' => 'Musical', 
			'description' => 'Al referirnos al género musical, aludimos a todas aquellas producciones cinematográficas cuya temática gire en torno o se manifieste a través de expresiones musicales que incluyan canciones o temas bailables como parte fundamental de su desarrollo dramático.', 
			'adult' => false
		),
		array(
			'title' => 'Ciencia Ficción', 
			'description' => 'Género cinematográfico al que pertenecen películas que narran historias en un futuro imaginario, ordinariamente caracterizado por un desarrollo tecnológico mayor.', 
			'adult' => false
		),
		array(
			'title' => 'Bélicas', 
			'description' => 'Género cinematográfico que trata de hazañas épicas reales o ficticias en campo de batalla. Se puede subclasificar en: Guerras del Siglo XX, Cine Épico y Cine de Romanos.', 
			'adult' => false
		),
		array(
			'title' => 'Western', 
			'description' => 'Como su nombre indica es el género cinematográfico que relata historias relacionadas con la conquista y colonización de los territorios occidentales de Estados Unidos.', 
			'adult' => false
		),
		array(
			'title' => 'Suspense', 
			'description' => 'También llamado intriga o thriller, aborda sucesos criminales o que entrañan amenazas de muerte, aunque éstos quedan en segundo plano frente al mecanismo narrativo que hace de la participación del espectador –a quien se proporciona una información hábilmente dosificada cuando no manipulada– y de diversas hipótesis sobre los interrogantes planteados el motivo espectacular.', 
			'adult' => true
		),
		array(
			'title' => 'Infantil', 
			'description' => 'Película que por su temática va dirigido a los niños, con fines didácticos o de entretenimiento, basados en situaciones de la vida real o ficciones, por lo general presentadas en dibujos animados, filmaciones reales o mezcla de ambos.', 
			'adult' => false
		),
		array(
			'title' => 'Adultos', 
			'description' => 'El cine pornográfico (también llamado cine porno, o simplemente porno) es aquél en el que explícitamente se muestran los genitales mientras se realiza el acto sexual y cuyo único propósito es el de excitar al espectador, es totalmente de esencia física y erótica ya que se representan las vivencias íntimas entre las parejas.', 
			'adult' => true
			)
	
		);

}
