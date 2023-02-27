-- View: public.view_indicador4_data

-- DROP VIEW public.view_indicador4_data;

CREATE OR REPLACE VIEW public.view_indicador4_data
 AS
 SELECT a.region,
    a.procedimiento,
    a.year,
    a.month,
    ((((a.month || '/'::text) || '01'::text) || '/'::text) || a.year)::date AS fecha,
    1::double precision - a.completos::double precision / a.total::double precision AS porcentaje
   FROM view_m_indicador4 a;



