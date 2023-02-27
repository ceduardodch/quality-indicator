-- View: public.view_indicador16_data

-- DROP VIEW public.view_indicador16_data;

CREATE OR REPLACE VIEW public.view_indicador16_data
 AS
 SELECT a.region,
    a.procedimiento,
    a.year,
    a.month,
	  ((((a.month || '/'::text) || '01'::text) || '/'::text) || a.year)::date AS fecha,
    a.monto_licitado,
    a.fase
   FROM view_m_indicador16 a;



