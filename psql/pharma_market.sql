--
-- PostgreSQL database dump
--

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: categories; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public.categories (
    id integer NOT NULL,
    category_name character varying(100) NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone
);


ALTER TABLE public.categories OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.categories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.categories_id_seq OWNER TO postgres;

--
-- Name: categories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.categories_id_seq OWNED BY public.categories.id;


--
-- Name: invoices; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public.invoices (
    id integer NOT NULL,
    user_id integer NOT NULL,
    product_id integer NOT NULL,
    state_id integer NOT NULL,
    qtd_product integer NOT NULL,
    hash_invoice character varying(100) NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone
);


ALTER TABLE public.invoices OWNER TO postgres;

--
-- Name: invoices_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.invoices_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.invoices_id_seq OWNER TO postgres;

--
-- Name: invoices_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.invoices_id_seq OWNED BY public.invoices.id;


--
-- Name: laboratories; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public.laboratories (
    id integer NOT NULL,
    lab_name character varying(100) NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone
);


ALTER TABLE public.laboratories OWNER TO postgres;

--
-- Name: laboratories_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.laboratories_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.laboratories_id_seq OWNER TO postgres;

--
-- Name: laboratories_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.laboratories_id_seq OWNED BY public.laboratories.id;


--
-- Name: products; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public.products (
    id integer NOT NULL,
    name character varying(100) NOT NULL,
    apresentation character varying(255) NOT NULL,
    laboratory_id integer NOT NULL,
    category_id integer NOT NULL,
    price numeric(10,2) NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone,
    ean character varying(14) NOT NULL
);


ALTER TABLE public.products OWNER TO postgres;

--
-- Name: products_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.products_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.products_id_seq OWNER TO postgres;

--
-- Name: products_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.products_id_seq OWNED BY public.products.id;


--
-- Name: states; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public.states (
    id integer NOT NULL,
    uf character varying(2) NOT NULL,
    name character varying(100) NOT NULL,
    created_at timestamp without time zone DEFAULT now() NOT NULL,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone
);


ALTER TABLE public.states OWNER TO postgres;

--
-- Name: taxes; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public.taxes (
    id integer NOT NULL,
    category_id integer NOT NULL,
    state_id integer NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone,
    value numeric(3,3)
);


ALTER TABLE public.taxes OWNER TO postgres;

--
-- Name: taxes_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.taxes_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.taxes_id_seq OWNER TO postgres;

--
-- Name: taxes_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.taxes_id_seq OWNED BY public.taxes.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: postgres; Tablespace: 
--

CREATE TABLE public.users (
    id integer NOT NULL,
    name character varying(255) NOT NULL,
    cpf character varying(16) NOT NULL,
    email character varying(70) NOT NULL,
    password character varying(255) NOT NULL,
    access_level integer NOT NULL,
    created_at timestamp without time zone NOT NULL,
    updated_at timestamp without time zone,
    deleted_at timestamp without time zone,
    state_id integer DEFAULT 31 NOT NULL
);


ALTER TABLE public.users OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO postgres;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.categories ALTER COLUMN id SET DEFAULT nextval('public.categories_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.invoices ALTER COLUMN id SET DEFAULT nextval('public.invoices_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.laboratories ALTER COLUMN id SET DEFAULT nextval('public.laboratories_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products ALTER COLUMN id SET DEFAULT nextval('public.products_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxes ALTER COLUMN id SET DEFAULT nextval('public.taxes_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Data for Name: categories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.categories (id, category_name, created_at, updated_at, deleted_at) FROM stdin;
1	Éticos	2019-07-01 15:27:33.864927	2019-07-03 02:50:32.502829	\N
2	Genéricos	2019-07-03 02:23:12.296326	2019-07-03 02:50:39.223092	\N
\.


--
-- Name: categories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.categories_id_seq', 2, true);


--
-- Data for Name: invoices; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.invoices (id, user_id, product_id, state_id, qtd_product, hash_invoice, created_at, updated_at, deleted_at) FROM stdin;
1	4	2	31	1	675809f99d7ab538fa6819abcc5572ff	2019-07-06 03:49:27.400443	\N	\N
2	4	3	31	1	675809f99d7ab538fa6819abcc5572ff	2019-07-06 03:49:27.40907	\N	\N
3	4	2	31	1	fcfe86ffabff51817440d33ffe1c234c	2019-07-06 03:52:39.414001	\N	\N
4	4	3	31	1	fcfe86ffabff51817440d33ffe1c234c	2019-07-06 03:52:39.422387	\N	\N
5	5	2	31	4	3199a1b26ed3015430750b618168d8ee	2019-07-06 03:54:30.808928	\N	\N
6	5	3	31	5	3199a1b26ed3015430750b618168d8ee	2019-07-06 03:54:30.820814	\N	\N
\.


--
-- Name: invoices_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.invoices_id_seq', 6, true);


--
-- Data for Name: laboratories; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.laboratories (id, lab_name, created_at, updated_at, deleted_at) FROM stdin;
1	ALCON	2019-07-04 00:06:39.185203	\N	\N
2	SANDOZ	2019-07-04 00:06:39.185203	\N	\N
3	LEGRAND	2019-07-04 00:06:39.185203	\N	\N
4	EMS GENÉRICOS	2019-07-04 00:06:39.185203	\N	\N
5	EMS SIGMA	2019-07-04 00:06:39.185203	\N	\N
6	EUROFARMA	2019-07-04 00:06:39.185203	\N	\N
7	BIOLAB	2019-07-04 00:06:39.185203	\N	\N
8	NEOQUIMICA	2019-07-04 00:06:39.185203	\N	\N
9	MEDLEY	2019-07-04 00:06:39.185203	\N	\N
\.


--
-- Name: laboratories_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.laboratories_id_seq', 9, true);


--
-- Data for Name: products; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.products (id, name, apresentation, laboratory_id, category_id, price, created_at, updated_at, deleted_at, ean) FROM stdin;
1	ACICLOVIR	200 MG COM CT BL AL PLAS INC X 25	2	2	66.34	2019-07-04 01:38:29.668838	2019-07-04 22:11:42.604687	2019-07-04 22:17:44.588618	7897595602626
2	ACICLOVIR	200 MG COM CT BL AL PLAS INC X 25	2	1	66.36	2019-07-05 01:44:21.780901	\N	\N	7897595602626
3	DICLOFENACO DE SÓDIO	15MG C/30	2	1	45.90	2019-07-05 16:05:43.793997	2019-07-05 16:07:19.569217	\N	7891231231233
\.


--
-- Name: products_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.products_id_seq', 3, true);


--
-- Data for Name: states; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.states (id, uf, name, created_at, updated_at, deleted_at) FROM stdin;
11	RO	Rondônia	2019-07-02 01:19:50.041141	\N	\N
12	AC	Acre	2019-07-02 01:19:50.041141	\N	\N
13	AM	Amazonas	2019-07-02 01:19:50.041141	\N	\N
14	RR	Roraima	2019-07-02 01:19:50.041141	\N	\N
15	PA	Pará	2019-07-02 01:19:50.041141	\N	\N
16	AP	Amapá	2019-07-02 01:19:50.041141	\N	\N
17	TO	Tocantins	2019-07-02 01:19:50.041141	\N	\N
21	MA	Maranhão	2019-07-02 01:19:50.041141	\N	\N
22	PI	Piauí	2019-07-02 01:19:50.041141	\N	\N
23	CE	Ceará	2019-07-02 01:19:50.041141	\N	\N
24	RN	Rio Grande do Norte	2019-07-02 01:19:50.041141	\N	\N
25	PB	Paraíba	2019-07-02 01:19:50.041141	\N	\N
26	PE	Pernambuco	2019-07-02 01:19:50.041141	\N	\N
27	AL	Alagoas	2019-07-02 01:19:50.041141	\N	\N
28	SE	Sergipe	2019-07-02 01:19:50.041141	\N	\N
29	BA	Bahia	2019-07-02 01:19:50.041141	\N	\N
31	MG	Minas Gerais	2019-07-02 01:19:50.041141	\N	\N
32	ES	Espírito Santo	2019-07-02 01:19:50.041141	\N	\N
33	RJ	Rio de Janeiro	2019-07-02 01:19:50.041141	\N	\N
35	SP	São Paulo	2019-07-02 01:19:50.041141	\N	\N
41	PR	Paraná	2019-07-02 01:19:50.041141	\N	\N
42	SC	Santa Catarina	2019-07-02 01:19:50.041141	\N	\N
43	RS	Rio Grande do Sul	2019-07-02 01:19:50.041141	\N	\N
50	MS	Mato Grosso do Sul	2019-07-02 01:19:50.041141	\N	\N
51	MT	Mato Grosso	2019-07-02 01:19:50.041141	\N	\N
52	GO	Goiás	2019-07-02 01:19:50.041141	\N	\N
53	DF	Distrito Federal	2019-07-02 01:19:50.041141	\N	\N
\.


--
-- Data for Name: taxes; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.taxes (id, category_id, state_id, created_at, updated_at, deleted_at, value) FROM stdin;
8	1	31	2019-07-03 15:20:04.216056	\N	2019-07-03 15:34:17.403496	0.180
9	1	12	2019-07-03 15:35:43.584785	\N	2019-07-03 15:35:56.880305	0.180
10	1	12	2019-07-03 15:38:50.117079	\N	2019-07-03 15:39:05.874096	0.180
11	1	12	2019-07-03 15:39:18.630488	2019-07-03 15:55:35.135608	\N	0.172
\.


--
-- Name: taxes_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.taxes_id_seq', 11, true);


--
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.users (id, name, cpf, email, password, access_level, created_at, updated_at, deleted_at, state_id) FROM stdin;
2	LUIZ HENRIQUE NUNES NASCIMENTO	9	luizbmthoz@gmail.com	$2y$10$2EDk/SNld0o/Y4WXUkUVlOV1Q.5PPk8D94pP5/wiQO96u6rvx0IYK	8	2019-07-04 23:20:56.257583	\N	\N	31
3	ADMINISTRADOR SISTEMA	99	admin@admin.com.br	$2y$10$p1Wdk4b/8dL3B2mu5JJMie21hJGOr4wHKoa4cn7GLo0zrnrkTnTNK	8	2019-07-05 00:21:30.567885	\N	\N	31
4	CLIENTE DE TESTES	12526617030	teste@clientexemplo.com.br	$2y$10$bGQst9liPfpNumV77PbDBeUHGdUTTwp9AisN7I26uMgfZLUeS7gje	1	2019-07-06 00:29:08.799793	\N	\N	31
5	CLIENTE TESTES 2	16101234096	cliente2@exemplo.com.br	$2y$10$YR/MA6xsYeiyDsKOejCC4ez6FH0pQ1d5IIIstrJbAns7dKbBbvvBC	1	2019-07-06 00:32:44.174499	\N	\N	31
\.


--
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.users_id_seq', 5, true);


--
-- Name: categories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public.categories
    ADD CONSTRAINT categories_pkey PRIMARY KEY (id);


--
-- Name: invoices_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public.invoices
    ADD CONSTRAINT invoices_pkey PRIMARY KEY (id);


--
-- Name: laboratories_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public.laboratories
    ADD CONSTRAINT laboratories_pkey PRIMARY KEY (id);


--
-- Name: states_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public.states
    ADD CONSTRAINT states_pkey PRIMARY KEY (id);


--
-- Name: taxes_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public.taxes
    ADD CONSTRAINT taxes_pkey PRIMARY KEY (id, category_id, state_id);


--
-- Name: users_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_email_key UNIQUE (email);


--
-- Name: users_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres; Tablespace: 
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id, cpf);


--
-- Name: products_category_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE CASCADE;


--
-- Name: products_laboratory_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.products
    ADD CONSTRAINT products_laboratory_id_fkey FOREIGN KEY (laboratory_id) REFERENCES public.laboratories(id) ON DELETE CASCADE;


--
-- Name: taxes_category_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxes
    ADD CONSTRAINT taxes_category_id_fkey FOREIGN KEY (category_id) REFERENCES public.categories(id) ON DELETE CASCADE;


--
-- Name: taxes_state_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.taxes
    ADD CONSTRAINT taxes_state_id_fkey FOREIGN KEY (state_id) REFERENCES public.states(id) ON DELETE CASCADE;


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

