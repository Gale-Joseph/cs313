--
-- PostgreSQL database dump
--

-- Dumped from database version 12.1
-- Dumped by pg_dump version 12.1

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: portfolio; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.portfolio (
    id integer NOT NULL,
    symbol character varying NOT NULL,
    date date NOT NULL,
    buyprice double precision NOT NULL,
    shares bigint NOT NULL,
    currentprice double precision NOT NULL,
    currentvalue double precision GENERATED ALWAYS AS (((shares)::double precision * currentprice)) STORED,
    profit double precision GENERATED ALWAYS AS ((((shares)::double precision * currentprice) - ((shares)::double precision * buyprice))) STORED
);


ALTER TABLE public.portfolio OWNER TO postgres;

--
-- Name: portfolio_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.portfolio_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.portfolio_id_seq OWNER TO postgres;

--
-- Name: portfolio_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.portfolio_id_seq OWNED BY public.portfolio.id;


--
-- Name: tradeAcct; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."tradeAcct" (
    id integer NOT NULL,
    transid integer NOT NULL
);


ALTER TABLE public."tradeAcct" OWNER TO postgres;

--
-- Name: tradeAcct_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public."tradeAcct_id_seq"
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public."tradeAcct_id_seq" OWNER TO postgres;

--
-- Name: tradeAcct_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public."tradeAcct_id_seq" OWNED BY public."tradeAcct".id;


--
-- Name: trans; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.trans (
    id bigint NOT NULL,
    date date NOT NULL,
    symbol character varying NOT NULL,
    price double precision NOT NULL,
    shares integer NOT NULL,
    isstock boolean NOT NULL,
    total double precision
);


ALTER TABLE public.trans OWNER TO postgres;

--
-- Name: trans_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.trans_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.trans_id_seq OWNER TO postgres;

--
-- Name: trans_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.trans_id_seq OWNED BY public.trans.id;


--
-- Name: user; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public."user" (
    id integer NOT NULL,
    firstname character varying NOT NULL,
    lastname character varying NOT NULL,
    bankacct character varying NOT NULL,
    portid integer NOT NULL,
    tradeacctid integer NOT NULL
);


ALTER TABLE public."user" OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.user_id_seq OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;


--
-- Name: portfolio id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.portfolio ALTER COLUMN id SET DEFAULT nextval('public.portfolio_id_seq'::regclass);


--
-- Name: tradeAcct id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tradeAcct" ALTER COLUMN id SET DEFAULT nextval('public."tradeAcct_id_seq"'::regclass);


--
-- Name: trans id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trans ALTER COLUMN id SET DEFAULT nextval('public.trans_id_seq'::regclass);


--
-- Name: user id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);


--
-- Data for Name: portfolio; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.portfolio (id, symbol, date, buyprice, shares, currentprice) FROM stdin;
1	aapl	2020-01-22	300	3	310
\.


--
-- Data for Name: tradeAcct; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."tradeAcct" (id, transid) FROM stdin;
\.


--
-- Data for Name: trans; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.trans (id, date, symbol, price, shares, isstock, total) FROM stdin;
\.


--
-- Data for Name: user; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public."user" (id, firstname, lastname, bankacct, portid, tradeacctid) FROM stdin;
\.


--
-- Name: portfolio_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.portfolio_id_seq', 1, true);


--
-- Name: tradeAcct_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public."tradeAcct_id_seq"', 1, false);


--
-- Name: trans_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.trans_id_seq', 1, false);


--
-- Name: user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_id_seq', 1, false);


--
-- Name: portfolio portfolio_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.portfolio
    ADD CONSTRAINT portfolio_pkey PRIMARY KEY (id);


--
-- Name: tradeAcct tradeAcct_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tradeAcct"
    ADD CONSTRAINT "tradeAcct_pkey" PRIMARY KEY (id);


--
-- Name: trans trans_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.trans
    ADD CONSTRAINT trans_pkey PRIMARY KEY (id);


--
-- Name: user user_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);


--
-- Name: fki_fk_constraint_1; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_fk_constraint_1 ON public."user" USING btree (portid);


--
-- Name: fki_fk_constraint_2; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_fk_constraint_2 ON public."user" USING btree (tradeacctid);


--
-- Name: fki_fk_constraint_3; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX fki_fk_constraint_3 ON public."tradeAcct" USING btree (transid);


--
-- Name: user fk_constraint_1; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT fk_constraint_1 FOREIGN KEY (portid) REFERENCES public.portfolio(id) NOT VALID;


--
-- Name: user fk_constraint_2; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."user"
    ADD CONSTRAINT fk_constraint_2 FOREIGN KEY (tradeacctid) REFERENCES public."tradeAcct"(id) NOT VALID;


--
-- Name: tradeAcct fk_constraint_3; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public."tradeAcct"
    ADD CONSTRAINT fk_constraint_3 FOREIGN KEY (transid) REFERENCES public.trans(id) NOT VALID;


--
-- PostgreSQL database dump complete
--

