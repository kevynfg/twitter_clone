# twitter_clone
Experimental project related to a programming course from Udemy to practice some twitter concepts with database queries.
Last challenge on this project was to make a delete button to the current logged in user only. And auto update on the interface about
current TWEETS and FOLLOWERS, also it uses md5 cryptography by PHP.


## Install and creating database for testing :bulb:

- Download the project files using git clone or download zip

- Install Xampp and initialize Apache and MySQL.

- Go to your explorer folders 'Xampp/htdocs' and paste twitter_clone inside it.

- On your web browser, try localhost/phpmyadmin. After getting to the phpmyadmin page, you must create twitter_clone database.

- After you create it's database, create these following tables:

create table usuarios (
    id int not null PRIMARY KEY AUTO_INCREMENT,
    usuario varchar(50) not null,
    email varchar(100) not null,
    senha varchar(32) not null
);

create table tweet (
	id_tweet int not null primary key AUTO_INCREMENT,
    id_usuario int not null,
    tweet varchar(140) not null,
    data_inclusao datetime default CURRENT_TIMESTAMP
);

create table usuarios_seguidores (
	id_usuario_seguidor int not null primary key AUTO_INCREMENT,
    id_usuario int not null,
    seguindo_id_usuario int not null,
    data_registro datetime default CURRENT_TIMESTAMP
);

After all these steps were done, you can start to try and use the project.

**Image inside the home page with feed and logged in user**

<img src="/imagens/twitter.png"> 
<img src="https://media.giphy.com/media/V5FMEY4LEwKAljBrMK/giphy.gif"/> 
<img src="https://media.giphy.com/media/Uvqsa3KgUdlmRgWeqI/giphy.gif"/> 
<img src="https://media.giphy.com/media/vmbutuIBN99YtY4KyQ/giphy.gif"/> 

## FEATURES :star:

- register new user
- tweet
- follow people
- unfollow
- tweet feed
- delete tweet


Made by Kevyn :metal:
