-- View: public.view_indicador14_data

-- DROP VIEW public.view_indicador14_data;

CREATE OR REPLACE VIEW public.view_indicador14_data
 AS
 SELECT a.region,
    a.procedimiento,
    a.year,
    a.month,
	    ((((a.month || '/'::text) || '01'::text) || '/'::text) || a.year)::date AS fecha,

    a.monto_cambio AS amount_diff,
    a.total AS register_number
   FROM view_m_indicador14 a;


