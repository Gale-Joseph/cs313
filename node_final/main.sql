CREATE TABLE customer
( id SERIAL PRIMARY KEY
, firstname TEXT NOT NULL
, lastname TEXT NOT NULL
, email TEXT NOT NULL
, password TEXT NOT NULL
);

CREATE TABLE purchase
(id SERIAL PRIMARY KEY
, customerid INT NOT NULL REFERENCES customer(id)
, ticker TEXT NOT NULL
, price NUMERIC NOT NULL
, shares INT NOT NULL
);
