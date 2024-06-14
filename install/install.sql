create table if not exists country
(
    id    int          not null primary key auto_increment,
    title varchar(255) not null
);

create table if not exists car_type
(
    id    int not null primary key auto_increment,
    title varchar(255)
);

create table if not exists car_brand
(
    id    int          not null primary key auto_increment,
    title varchar(255) not null
);

create table if not exists car_body
(
    id    int          not null primary key auto_increment,
    title varchar(255) not null
);

create table if not exists image
(
    id             int          not null primary key auto_increment,
    title          varchar(255) not null,
    original_title varchar(255) not null,
    path           varchar(255) not null,
    height         int          not null,
    width          int          not null,
    extension      varchar(10)  not null
);

create table if not exists famous_people
(
    id       int primary key auto_increment,
    name     varchar(255) not null,
    surname  varchar(255) not null,
    image_id int,

    foreign key FK_FPEOPLE_IMAGE (image_id)
        references image (id)
        on delete cascade
        on update cascade
);

create table if not exists factory
(
    id          int primary key auto_increment,
    title       varchar(255) not null,
    description varchar(400) not null,
    image_id    int,
    country_id  int          not null,

    foreign key FK_FACTORY_IMAGE (image_id)
        references image (id)
        on delete cascade
        on update cascade,

    foreign key FK_FACTORY_COUNTRY (country_id)
        references country (id)
        on delete cascade
        on update cascade
);

create table if not exists car_configuration
(
    id               int primary key auto_increment,
    title            varchar(255) not null,
    description      varchar(400) not null,
    brand_id         int          not null,
    type_id          int          not null,
    body_id          int          not null,
    engine_capacity  float        not null,
    analogues_number int,

    foreign key FK_CONFIGURATION_BRAND (brand_id)
        references car_brand (id)
        on delete cascade
        on update cascade,

    foreign key FK_CONFIGURATION_TYPE (type_id)
        references car_type (id)
        on delete cascade
        on update cascade,

    foreign key FK_CONFIGURATION_BODY (body_id)
        references car_body (id)
        on delete cascade
        on update cascade
);

create table if not exists car
(
    id                     int primary key auto_increment,
    configuration_id       int   not null,
    release_year           int   not null,
    original_parts_percent float not null,
    factory_id             int   not null,
    image_id               int,

    foreign key FK_CAR_CONFIGURATION (configuration_id)
        references car_configuration (id)
        on delete cascade
        on update cascade,

    foreign key FK_CAR_FACTORY (factory_id)
        references factory (id)
        on delete cascade
        on update cascade,

    foreign key FK_CAR_IMAGE (image_id)
        references image (id)
        on delete cascade
        on update cascade
);

create table if not exists car_fpeople
(
    car_id   int not null,
    human_id int not null,

    primary key (car_id, human_id),

    foreign key FK_CP_CAR (car_id)
        references car (id)
        on delete cascade
        on update cascade,

    foreign key FK_CP_FPEOPLE (human_id)
        references famous_people (id)
        on delete cascade
        on update cascade
);

create table if not exists museum
(
    id          int auto_increment primary key,
    title       varchar(255) not null,
    description varchar(400) not null,
    country_id   int          not null,
    image_id    int,

    foreign key FK_MUSEUM_COUNTRY (country_id)
        references country (id)
        on delete cascade
        on update cascade,
    foreign key FK_MUSEUM_IMAGE (image_id)
        references image (id)
        on delete cascade
        on update cascade
);

create table if not exists museum_entry
(
    car_id      int not null unique,
    museum_id   int not null,
    entry_year  int not null,
    room_number int not null,
    image_id    int,

    primary key (car_id, museum_id),

    foreign key FK_ME_CAR (car_id)
        references car (id)
        on delete cascade
        on update cascade,

    foreign key FK_ME_MUSEUM (museum_id)
        references museum (id)
        on delete cascade
        on update cascade,

    foreign key FK_ME_IMAGE (image_id)
        references image (id)
        on delete cascade
        on update cascade
);
