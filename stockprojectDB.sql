PGDMP     6                     x            d1ali0b11dpglf     11.6 (Ubuntu 11.6-1.pgdg16.04+1)    12.1 2    4           0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false            5           0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false            6           0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false            7           1262    44609481    d1ali0b11dpglf    DATABASE     �   CREATE DATABASE d1ali0b11dpglf WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'en_US.UTF-8' LC_CTYPE = 'en_US.UTF-8';
    DROP DATABASE d1ali0b11dpglf;
                afcznoceukzzju    false            8           0    0    DATABASE d1ali0b11dpglf    ACL     A   REVOKE CONNECT,TEMPORARY ON DATABASE d1ali0b11dpglf FROM PUBLIC;
                   afcznoceukzzju    false    3895            9           0    0    SCHEMA public    ACL     �   REVOKE ALL ON SCHEMA public FROM postgres;
REVOKE ALL ON SCHEMA public FROM PUBLIC;
GRANT ALL ON SCHEMA public TO afcznoceukzzju;
GRANT ALL ON SCHEMA public TO PUBLIC;
                   afcznoceukzzju    false    3            :           0    0    LANGUAGE plpgsql    ACL     1   GRANT ALL ON LANGUAGE plpgsql TO afcznoceukzzju;
                   postgres    false    624            �            1259    44940917    port_id_seq    SEQUENCE     t   CREATE SEQUENCE public.port_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.port_id_seq;
       public          afcznoceukzzju    false            �            1259    44920752 	   portfolio    TABLE     �   CREATE TABLE public.portfolio (
    id integer DEFAULT nextval('public.port_id_seq'::regclass) NOT NULL,
    ticker character varying NOT NULL,
    buydate date NOT NULL,
    buyprice double precision NOT NULL,
    shares integer,
    userid integer
);
    DROP TABLE public.portfolio;
       public            afcznoceukzzju    false    204            �            1259    44917761    test    TABLE     [   CREATE TABLE public.test (
    id integer NOT NULL,
    name character varying NOT NULL
);
    DROP TABLE public.test;
       public            afcznoceukzzju    false            �            1259    44917759    test_id_seq    SEQUENCE     �   CREATE SEQUENCE public.test_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.test_id_seq;
       public          afcznoceukzzju    false    197            ;           0    0    test_id_seq    SEQUENCE OWNED BY     ;   ALTER SEQUENCE public.test_id_seq OWNED BY public.test.id;
          public          afcznoceukzzju    false    196            �            1259    44920736 	   tradeacct    TABLE     Y   CREATE TABLE public.tradeacct (
    id integer NOT NULL,
    transid integer NOT NULL
);
    DROP TABLE public.tradeacct;
       public            afcznoceukzzju    false            �            1259    44920743    trans    TABLE     Q  CREATE TABLE public.trans (
    id integer NOT NULL,
    date date NOT NULL,
    ticker character varying DEFAULT 'none'::character varying,
    price double precision DEFAULT 0.00,
    shares integer DEFAULT 0,
    stocktotal double precision DEFAULT 0.00,
    deposittotal double precision DEFAULT 0.00,
    userid integer NOT NULL
);
    DROP TABLE public.trans;
       public            afcznoceukzzju    false            �            1259    44920741    trans_id_seq    SEQUENCE     �   CREATE SEQUENCE public.trans_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 #   DROP SEQUENCE public.trans_id_seq;
       public          afcznoceukzzju    false    202            <           0    0    trans_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.trans_id_seq OWNED BY public.trans.id;
          public          afcznoceukzzju    false    201            �            1259    44920726    user    TABLE     I  CREATE TABLE public."user" (
    id integer NOT NULL,
    firstname character varying NOT NULL,
    lastname character varying NOT NULL,
    email character varying NOT NULL,
    level integer,
    tradeacctamount double precision,
    password character varying,
    tradeacctid integer NOT NULL,
    portid integer NOT NULL
);
    DROP TABLE public."user";
       public            afcznoceukzzju    false            �            1259    44920724    user_id_seq    SEQUENCE     �   CREATE SEQUENCE public.user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 "   DROP SEQUENCE public.user_id_seq;
       public          afcznoceukzzju    false    199            =           0    0    user_id_seq    SEQUENCE OWNED BY     =   ALTER SEQUENCE public.user_id_seq OWNED BY public."user".id;
          public          afcznoceukzzju    false    198            �            1259    44945492    user_portid_seq    SEQUENCE     �   CREATE SEQUENCE public.user_portid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 &   DROP SEQUENCE public.user_portid_seq;
       public          afcznoceukzzju    false    199            >           0    0    user_portid_seq    SEQUENCE OWNED BY     E   ALTER SEQUENCE public.user_portid_seq OWNED BY public."user".portid;
          public          afcznoceukzzju    false    206            �            1259    44945464    user_tradeacctid_seq    SEQUENCE     �   CREATE SEQUENCE public.user_tradeacctid_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 +   DROP SEQUENCE public.user_tradeacctid_seq;
       public          afcznoceukzzju    false    199            ?           0    0    user_tradeacctid_seq    SEQUENCE OWNED BY     O   ALTER SEQUENCE public.user_tradeacctid_seq OWNED BY public."user".tradeacctid;
          public          afcznoceukzzju    false    205            �           2604    44917764    test id    DEFAULT     b   ALTER TABLE ONLY public.test ALTER COLUMN id SET DEFAULT nextval('public.test_id_seq'::regclass);
 6   ALTER TABLE public.test ALTER COLUMN id DROP DEFAULT;
       public          afcznoceukzzju    false    196    197    197            �           2604    44920746    trans id    DEFAULT     d   ALTER TABLE ONLY public.trans ALTER COLUMN id SET DEFAULT nextval('public.trans_id_seq'::regclass);
 7   ALTER TABLE public.trans ALTER COLUMN id DROP DEFAULT;
       public          afcznoceukzzju    false    202    201    202            �           2604    44920729    user id    DEFAULT     d   ALTER TABLE ONLY public."user" ALTER COLUMN id SET DEFAULT nextval('public.user_id_seq'::regclass);
 8   ALTER TABLE public."user" ALTER COLUMN id DROP DEFAULT;
       public          afcznoceukzzju    false    199    198    199            �           2604    44945466    user tradeacctid    DEFAULT     v   ALTER TABLE ONLY public."user" ALTER COLUMN tradeacctid SET DEFAULT nextval('public.user_tradeacctid_seq'::regclass);
 A   ALTER TABLE public."user" ALTER COLUMN tradeacctid DROP DEFAULT;
       public          afcznoceukzzju    false    205    199            �           2604    44945494    user portid    DEFAULT     l   ALTER TABLE ONLY public."user" ALTER COLUMN portid SET DEFAULT nextval('public.user_portid_seq'::regclass);
 <   ALTER TABLE public."user" ALTER COLUMN portid DROP DEFAULT;
       public          afcznoceukzzju    false    206    199            .          0    44920752 	   portfolio 
   TABLE DATA           R   COPY public.portfolio (id, ticker, buydate, buyprice, shares, userid) FROM stdin;
    public          afcznoceukzzju    false    203   �6       (          0    44917761    test 
   TABLE DATA           (   COPY public.test (id, name) FROM stdin;
    public          afcznoceukzzju    false    197   57       +          0    44920736 	   tradeacct 
   TABLE DATA           0   COPY public.tradeacct (id, transid) FROM stdin;
    public          afcznoceukzzju    false    200   [7       -          0    44920743    trans 
   TABLE DATA           b   COPY public.trans (id, date, ticker, price, shares, stocktotal, deposittotal, userid) FROM stdin;
    public          afcznoceukzzju    false    202   |7       *          0    44920726    user 
   TABLE DATA           w   COPY public."user" (id, firstname, lastname, email, level, tradeacctamount, password, tradeacctid, portid) FROM stdin;
    public          afcznoceukzzju    false    199   �8       @           0    0    port_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.port_id_seq', 105, true);
          public          afcznoceukzzju    false    204            A           0    0    test_id_seq    SEQUENCE SET     9   SELECT pg_catalog.setval('public.test_id_seq', 1, true);
          public          afcznoceukzzju    false    196            B           0    0    trans_id_seq    SEQUENCE SET     ;   SELECT pg_catalog.setval('public.trans_id_seq', 59, true);
          public          afcznoceukzzju    false    201            C           0    0    user_id_seq    SEQUENCE SET     :   SELECT pg_catalog.setval('public.user_id_seq', 11, true);
          public          afcznoceukzzju    false    198            D           0    0    user_portid_seq    SEQUENCE SET     >   SELECT pg_catalog.setval('public.user_portid_seq', 10, true);
          public          afcznoceukzzju    false    206            E           0    0    user_tradeacctid_seq    SEQUENCE SET     C   SELECT pg_catalog.setval('public.user_tradeacctid_seq', 12, true);
          public          afcznoceukzzju    false    205            �           2606    44920759    portfolio portfolio_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.portfolio
    ADD CONSTRAINT portfolio_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.portfolio DROP CONSTRAINT portfolio_pkey;
       public            afcznoceukzzju    false    203            �           2606    44917769    test test_pkey 
   CONSTRAINT     L   ALTER TABLE ONLY public.test
    ADD CONSTRAINT test_pkey PRIMARY KEY (id);
 8   ALTER TABLE ONLY public.test DROP CONSTRAINT test_pkey;
       public            afcznoceukzzju    false    197            �           2606    44920740    tradeacct tradeacct_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.tradeacct
    ADD CONSTRAINT tradeacct_pkey PRIMARY KEY (id);
 B   ALTER TABLE ONLY public.tradeacct DROP CONSTRAINT tradeacct_pkey;
       public            afcznoceukzzju    false    200            �           2606    44920751    trans trans_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public.trans
    ADD CONSTRAINT trans_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public.trans DROP CONSTRAINT trans_pkey;
       public            afcznoceukzzju    false    202            �           2606    44920734    user user_pkey 
   CONSTRAINT     N   ALTER TABLE ONLY public."user"
    ADD CONSTRAINT user_pkey PRIMARY KEY (id);
 :   ALTER TABLE ONLY public."user" DROP CONSTRAINT user_pkey;
       public            afcznoceukzzju    false    199            �           1259    44946562    fki_fk_port_userid    INDEX     J   CREATE INDEX fki_fk_port_userid ON public.portfolio USING btree (userid);
 &   DROP INDEX public.fki_fk_port_userid;
       public            afcznoceukzzju    false    203            �           1259    44946556    fki_fk_trans_userid    INDEX     G   CREATE INDEX fki_fk_trans_userid ON public.trans USING btree (userid);
 '   DROP INDEX public.fki_fk_trans_userid;
       public            afcznoceukzzju    false    202            �           1259    44920868 	   fki_trans    INDEX     B   CREATE INDEX fki_trans ON public.tradeacct USING btree (transid);
    DROP INDEX public.fki_trans;
       public            afcznoceukzzju    false    200            �           2606    44946557    portfolio fk_port_userid    FK CONSTRAINT     �   ALTER TABLE ONLY public.portfolio
    ADD CONSTRAINT fk_port_userid FOREIGN KEY (userid) REFERENCES public."user"(id) NOT VALID;
 B   ALTER TABLE ONLY public.portfolio DROP CONSTRAINT fk_port_userid;
       public          afcznoceukzzju    false    3745    199    203            �           2606    44946551    trans fk_trans_userid    FK CONSTRAINT     ~   ALTER TABLE ONLY public.trans
    ADD CONSTRAINT fk_trans_userid FOREIGN KEY (userid) REFERENCES public."user"(id) NOT VALID;
 ?   ALTER TABLE ONLY public.trans DROP CONSTRAINT fk_trans_userid;
       public          afcznoceukzzju    false    199    3745    202            �           2606    44920863    tradeacct trans    FK CONSTRAINT     x   ALTER TABLE ONLY public.tradeacct
    ADD CONSTRAINT trans FOREIGN KEY (transid) REFERENCES public.trans(id) NOT VALID;
 9   ALTER TABLE ONLY public.tradeacct DROP CONSTRAINT trans;
       public          afcznoceukzzju    false    200    3751    202            .   �   x�m��
�0����4٪Ϳ����$E�����E�Yyn��R
ز���t�!F��9�H3�b���R�MU���U�_Œ�f�R]�v΂Q�b���[t�{E4Mj����B��v�^b�_�ωݤ�ĭ�h��u�
cr*�1�-�K�      (      x�3���/N-������� �V      +      x�3�4����� ]      -   M  x����n�0���w��	?�`�jb�$&��k�!)��"U���@�Ek,[��w蕕���ֈ���n?��U9� ���a��1�������4�
�S��K�"��� �jSc�9 `׫����^�r^�v��Ep���g��.>Y�M4�h�H���g0B1�,�>�@.�i� �<ˎP�"�q�M(c`��<*T1жmԧF�.���; ��7�Y� �\:�s��O'����z�.�D�v�k��8�x8�B��z�v���~�K��@ N�/}��(�!> Ņ�h h_�\�JT��8�+q����i����p�،      *     x�]��n�0��y����4J� X���$�@�Ҁi���\ڪs���4PǾ�u����Y۪�Z\S�ܷ (����Pg]م�5��v]r�Z�dJl`�%��s/_R��m��K{;�� �`rl$C���=���?�4�Mm�c��n�A[���'L[�Bo�U�#Ӌ����VMˌk20N"6��F�F�%��!U)��)Oc�0�R�t�=DIL7y���l�dT1����7�-u���C�*�c#     