--
-- PostgreSQL database dump
--

-- Dumped from database version 16.3 (Debian 16.3-1.pgdg120+1)
-- Dumped by pg_dump version 16.3 (Debian 16.3-1.pgdg120+1)

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
-- Name: doctrine_migration_versions; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.doctrine_migration_versions (
    version character varying(191) NOT NULL,
    executed_at timestamp(0) without time zone DEFAULT NULL::timestamp without time zone,
    execution_time integer
);


ALTER TABLE public.doctrine_migration_versions OWNER TO postgres;

--
-- Name: post; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.post (
    id integer NOT NULL,
    unicorn_id integer NOT NULL,
    message character varying(255) NOT NULL,
    author character varying(255) NOT NULL,
    created_at timestamp(0) without time zone NOT NULL
);


ALTER TABLE public.post OWNER TO postgres;

--
-- Name: COLUMN post.created_at; Type: COMMENT; Schema: public; Owner: postgres
--

COMMENT ON COLUMN public.post.created_at IS '(DC2Type:datetime_immutable)';


--
-- Name: post_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.post_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.post_id_seq OWNER TO postgres;

--
-- Name: post_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.post_id_seq OWNED BY public.post.id;


--
-- Name: unicorn; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.unicorn (
    id integer NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.unicorn OWNER TO postgres;

--
-- Name: unicorn_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.unicorn_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.unicorn_id_seq OWNER TO postgres;

--
-- Name: unicorn_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.unicorn_id_seq OWNED BY public.unicorn.id;


--
-- Name: post id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post ALTER COLUMN id SET DEFAULT nextval('public.post_id_seq'::regclass);


--
-- Name: unicorn id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unicorn ALTER COLUMN id SET DEFAULT nextval('public.unicorn_id_seq'::regclass);


--
-- Data for Name: doctrine_migration_versions; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.doctrine_migration_versions (version, executed_at, execution_time) FROM stdin;
DoctrineMigrations\\Version20241107124730	2024-11-07 12:47:53	54
\.


--
-- Data for Name: post; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.post (id, unicorn_id, message, author, created_at) FROM stdin;
18	6	I love Sparkle!	Natan	2024-11-10 08:37:57
19	7	Rainbow is amazing!	Nona	2024-11-10 08:37:57
20	7	Rainbow is alright...	Natan	2024-11-10 08:37:57
\.


--
-- Data for Name: unicorn; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.unicorn (id, name) FROM stdin;
6	Sparkle
7	Rainbow
\.


--
-- Name: post_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.post_id_seq', 20, true);


--
-- Name: unicorn_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.unicorn_id_seq', 7, true);


--
-- Name: doctrine_migration_versions doctrine_migration_versions_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.doctrine_migration_versions
    ADD CONSTRAINT doctrine_migration_versions_pkey PRIMARY KEY (version);


--
-- Name: post post_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post
    ADD CONSTRAINT post_pkey PRIMARY KEY (id);


--
-- Name: unicorn unicorn_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.unicorn
    ADD CONSTRAINT unicorn_pkey PRIMARY KEY (id);


--
-- Name: idx_5a8a6c8d2af80346; Type: INDEX; Schema: public; Owner: postgres
--

CREATE INDEX idx_5a8a6c8d2af80346 ON public.post USING btree (unicorn_id);


--
-- Name: uniq_58fbd83f5e237e06; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_58fbd83f5e237e06 ON public.unicorn USING btree (name);


--
-- Name: post fk_5a8a6c8d2af80346; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.post
    ADD CONSTRAINT fk_5a8a6c8d2af80346 FOREIGN KEY (unicorn_id) REFERENCES public.unicorn(id);


--
-- PostgreSQL database dump complete
--

