CREATE DATABASE IF NOT EXISTS techsolv;

CREATE TABLE IF NOT EXISTS contact_form (
  id int(11) NOT NULL,
  full_name varchar(255) NOT NULL,
  phone varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  subjects varchar(255) NOT NULL,
  messags varchar(255) NOT NULL,
  ip_add varchar(255) NOT NULL,
  time_stamp varchar(255) NOT NULL DEFAULT current_timestamp()
)