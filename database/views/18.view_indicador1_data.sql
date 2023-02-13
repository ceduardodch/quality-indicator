-- View: public.view_indicador1_data

-- DROP VIEW public.view_indicador1_data;

CREATE OR REPLACE VIEW public.view_indicador1_data
 AS
 SELECT a.region,
    a.proceso,
    a.year,
    a.month,
    ((((a.month || '/'::text) || '01'::text) || '/'::text) || a.year)::date AS fecha,
    1::double precision - a.amountexist::double precision / a.conteo::double precision AS porcentaje
   FROM view_m_indicador1 a;

ALTER TABLE public.view_indicador1_data
    OWNER TO postgres;

