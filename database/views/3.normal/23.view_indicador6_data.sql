-- View: public.view_indicador6_data

-- DROP VIEW public.view_indicador6_data;

CREATE OR REPLACE VIEW public.view_indicador6_data
 AS
 SELECT a.region,
    (a.entidad_contratante::text || '-'::text) || a.region::text AS entidad_contratante,
    a.year,
    a.month,
    ((((a.month || '/'::text) || '01'::text) || '/'::text) || a.year)::date AS fecha,
    a.completos::double precision / a.total::double precision AS porcentaje
   FROM view_m_indicador6 a;

