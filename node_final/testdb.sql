CREATE TABLE purchase
( id SERIAL PRIMARY KEY
, ticker TEXT NOT NULL
, price NUMERIC NOT NULL
, shares INT NOT NULL
);

INSERT INTO purchase VALUES
(DEFAULT
,'appl'
,666.66
,3
);