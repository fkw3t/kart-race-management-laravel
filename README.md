# kart-race-management



<h1>todo</h1>



<h2>docker</h2>

* [x] xdebug

<h2>project structure</h2>

* [x] Modelagem do banco
* [x] Modelagem de entidades
* [] Estruturação de endpoints
    * [x] cadastro de usuarios 
    * [] busca de usuarios 
    * [] busca de stats de usuarios
    * [] atualizacao de usuarios 
    * [] cadastro de corridas 
    * [] busca de corridas 
    * [] busca de stats de corrida
    * [] atualizacao de corridas **OBS: enviar email p usuario**
    * [] cadastro de stats **OBS: enviar email p usuario**
    * [] usar laravel features: api resources, request validations(class), mails senders
* [] Autenticação - JWT
* [x] Documentação - Swagger


<h2>modelagem banco de dados</h2>

- table: user
    * id: int
    * name: varchar
    * document_number: varchar
    * email: varchar
    * phone: varchar
    * age: int

- table: races
    * id: int
    * data_start: datetime
    * data_end: datetime
    * laps: int
    * difficulty: varchar
    * local: varchar
    * number_runners: int
    * status: varchar


- table: users_races
    * race_id: int
    * user_id: int


- table: users_stats
    * id: int
    * user_id: int
    * race_id: int
    * position: tinyint
    *  
    * todo stats_columns 
    * todo stats_columns 
    * todo stats_columns

- table: races_stats
    * id: int
    * race_id: int
    * todo stats_columns 
    * todo stats_columns 
    * todo stats_columns 
    * todo stats_columns 
    * todo stats_columns 






