create database kahoot;

use kahoot;

create table if not exists user(
    id int auto_increment primary key,
    email varchar(250) not null,
    name varchar(60) not null,
    password varchar(512) not null,
    role varchar(15) not null,
    imgDirUser varchar(512),
    state varchar(60),
    check(role='normal' or role='premium'),
    unique(email)
);

create table if not exists user_token(
    id int  auto_increment primary key,
    token varchar(255) not null,
    expires datetime not null,
    state varchar(120) not null,
    fk_id_user int,
    foreign key (fk_id_user) references user(id) on delete cascade
)

create table if not exists quiz(
    id int auto_increment primary key,
    name varchar(60) not null,
    resume varchar(250),
    create_date date,
    num_questions int,
    num_plays int,
    fk_id_user int,
    foreign key (fk_id_user) references user(id) on delete cascade
);

create table if not exists question(
    id int auto_increment primary key,
    text_question varchar(300) not null,
    type varchar(30) not null,
    time int default 30,
    waitingTime int default 0,
    points int not null,
    fk_id_quiz int,
    imgDir varchar(512),
    foreign key (fk_id_quiz) references quiz(id) on delete cascade
);

create table if not exists answer(
    id int auto_increment primary key,
    text_answer varchar(150) not null,
    correct boolean not null,
    fk_id_question int,
    foreign key (fk_id_question) references question(id) on delete cascade
);

create table if not exists room(
    pin int primary key,
    event varchar(200) default '',
    fk_id_quiz int,
    foreign key (fk_id_quiz) references quiz(id) on delete cascade
);

create table if not exists player(
    id int auto_increment primary key,
    name varchar(60) not null,
    score int default 0,
    fk_pin_room int,
    foreign key (fk_pin_room) references room(pin) on delete cascade
);

create table if not exists player_answer(
    fk_id_answer int,
    fk_id_player int,
    foreign key (fk_id_answer) references answer(id) on delete cascade,
    foreign key (fk_id_player) references player(id) on delete cascade
);

insert into user (email, name, password, role) value('mateo.nal@gmail.com', 'Mateo', 'b03ddf3ca2e714a6548e7495e2a03f5e824eaac9837cd7f159c67b90fb4b7342', 'teacher');
insert into user (email, name, password, role) value('rjuanferragut@gmail.com', 'Rafa', 'b03ddf3ca2e714a6548e7495e2a03f5e824eaac9837cd7f159c67b90fb4b7342', 'teacher');
insert into user (email, name, password, role) value('oskralonso10@gmail.com', 'Oscar', 'b03ddf3ca2e714a6548e7495e2a03f5e824eaac9837cd7f159c67b90fb4b7342', 'teacher');

insert into quiz (name, resume, create_date, num_questions, num_plays, fk_id_user) value('Questionario1','Questionaraio de prueba 1', curdate(), 5, 0, 1);

insert into question (text_question, type, points, fk_id_quiz) value('¿Es Paris la capital de Francia?', 'true/false', 1000, 1);
insert into question (text_question, type, points, fk_id_quiz) value('¿10 x 2 - 10 = 10?', 'true/false', 1000, 1);
insert into question (text_question, type, points, fk_id_quiz) value('¿La capital de Españita es Murcia?', 'true/false', 1000, 1);
insert into question (text_question, type, points, fk_id_quiz) value('¿Leo Messi Juega en el Real Madrid?', 'true/false', 1000, 1);
insert into question (text_question, type, points, fk_id_quiz) value('¿El agua moja?', 'true/false', 1000, 1);

insert into answer (text_answer, correct, fk_id_question) value('True', true, 1);
insert into answer (text_answer, correct, fk_id_question) value('False', false, 1);
insert into answer (text_answer, correct, fk_id_question) value('True', true, 2);
insert into answer (text_answer, correct, fk_id_question) value('False', false, 2);
insert into answer (text_answer, correct, fk_id_question) value('True', false, 3);
insert into answer (text_answer, correct, fk_id_question) value('False', true, 3);
insert into answer (text_answer, correct, fk_id_question) value('True', false, 4);
insert into answer (text_answer, correct, fk_id_question) value('False', true, 4);
insert into answer (text_answer, correct, fk_id_question) value('True', true, 5);
insert into answer (text_answer, correct, fk_id_question) value('False', false, 5);

insert into room value(12345, '', 1);

insert into player (name, fk_pin_room) values ('Mateo', 12345);
insert into player (name, fk_pin_room) values ('Oscar', 12345);
insert into player (name, fk_pin_room) values ('Rafa', 12345);

insert into player_answer value(1,1);
insert into player_answer value(1,2);
insert into player_answer value(1,3);

insert into player_answer value(4,1);
insert into player_answer value(4,2);
insert into player_answer value(4,3);

insert into player_answer value(6,1);
insert into player_answer value(5,2);
insert into player_answer value(6,3);

-- ALTER TABLE user ADD state varchar(60) not null;
-- UPDATE user SET state='active';

CREATE USER 'admin'@'localhost' IDENTIFIED BY 'admin123';
GRANT ALL PRIVILEGES ON kahoot.* TO 'admin'@'localhost';
