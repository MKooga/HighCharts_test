create table past_hours_averages
(
  average varchar(11) null
)
;

create table pin
(
  pin varchar(12) not null
)
;

create table temperature
(
  id int not null auto_increment
    primary key,
  date_time time null,
  temperature int null
)
;

