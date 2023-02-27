-- View: public.view_indicador2_data

-- DROP VIEW public.view_indicador2_data;

CREATE OR REPLACE VIEW public.view_indicador2_data
 AS
 SELECT a.region,
    a.proceso,
    a.year,
    a.month,
    ((((a.month || '/'::text) || '01'::text) || '/'::text) || a.year)::date AS fecha,
    1::double precision - a.dateexist::double precision / a.conteo::double precision AS porcentaje
   FROM view_m_indicador2 a;



